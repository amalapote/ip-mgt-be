import {defineStore} from 'pinia'
import axios from 'axios'
import {computed, ref, reactive} from "vue";
import {useRouter} from 'vue-router'

export const useAuthStore = defineStore('auth', () => {

    const router = useRouter()

    //ref state
    const loading = ref(false);
    const disable = ref(false);
    const isSuccess = ref(false);
    const isError = ref(false);
    const errorResponse = ref(null);
    const successResponse = ref(null);
    const login = reactive({
        username: null,
        password: null,
    });

    // register
    const isErrorReg = ref(false);
    const errorResponseReg = ref(null);
    const signUp = reactive({
        email: null,
        first_name: null,
        last_name: null,
        password: null,
        password_confirmation: null,
    });

    //
    const  clearRegisterPayload = () => {
        signUp.email = null;
        signUp.first_name = null;
        signUp.last_name = null;
        signUp.password = null;
        signUp.password_confirmation = null;
        isSuccess.value = null;
        isError.value = null;
        disable.value = false;
        loading.value = false;
    }

    const  clearLoginPayload = () => {
        signUp.username = null;
        signUp.password = null;
        isSuccess.value = null;
        isError.value = null;
        disable.value = false;
        loading.value = false;
    }

    //getter is computed
    const getLoading = computed(() => loading.value)
    const getDisable = computed(() => disable.value)
    const getIsSuccess = computed(() => isSuccess.value);
    const getIsError = computed(() => isError.value);
    const getError = computed(() => errorResponse.value);
    const getSuccess = computed(() => successResponse.value);
    const getLoginPayLoad = computed(() => login);

    const getIsErrorReg = computed(() => isErrorReg.value);
    const getErrorReg = computed(() => errorResponseReg.value);


    //function is action
    async function auth() {

        loading.value = true;
        disable.value = true;

        await axios
            .post("/api/v1/auth/login", login)
            .then((response) => {
                successResponse.value = response.data
                clearLoginPayload();
                localStorage.setItem('access', JSON.stringify(response.data));
                setTimeout(function () {
                    window.location.href = '/admin/home';
                }, 1000);
            })
            .catch((error) => {
                errorResponse.value = error.response.data;
                isError.value = true;
                loading.value = false;
                isSuccess.value = false;
                disable.value = false;
            });
    }

    async function registration() {

        loading.value = true;
        disable.value = true;

        await axios
            .post("/api/v1/auth/register", signUp)
            .then((response) => {
                successResponse.value = response.data
                clearRegisterPayload();

                setTimeout(function () {
                    router.push('/')
                }, 1000);

            })
            .catch((error) => {
                console.log(error)
                errorResponse.value = error.response.data.errors;
                isError.value = true;
                loading.value = false;
                isSuccess.value = false;
                disable.value = false;
            });
    }

    async function logout() {

        await axios
            .post("/api/v1/auth/logout", signUp)
            .then((response) => {
                successResponse.value = response.data
                clearRegisterPayload();
                localStorage.removeItem('access');
                setTimeout(function () {
                    router.push('/')
                }, 1000);

            })
            .catch((error) => {
                errorResponse.value = error.response.data.errors;
                isError.value = true;
                loading.value = false;
                isSuccess.value = false;
                disable.value = false;
            });
    }

    return {
        auth,
        registration,
        login,
        getDisable,
        getLoading,
        getIsSuccess,
        getIsErrorReg,
        getErrorReg,
        getIsError,
        getError,
        getSuccess,
        getLoginPayLoad,
        signUp,
        loading,
        logout
    }
});
