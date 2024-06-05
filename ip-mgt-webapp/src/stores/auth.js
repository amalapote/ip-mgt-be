import {defineStore} from 'pinia'
import axios from 'axios'
import {computed, ref, reactive} from "vue";

export const useAuthStore = defineStore('auth', () => {

    //function is action
    //ref state
    const count = ref(0)
    const name = ref('Eduardodd')
    const idea = reactive({
        first_name:null,
        last_name:null,
    })

    //getter is computed
    const doubleCount = computed(() => count.value * 2)
    const getCount = computed(() => count.value);
    const getName = computed(() => name.value);
    const getIdea = computed(() => idea);

    //action
    const increment = () => {
        name.value = 'Apollo';
        count.value++
    }

    return { count, name, doubleCount, getCount, getName, increment, getIdea }
});
