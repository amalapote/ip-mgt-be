<script setup>
    import {useAuthStore} from '@/stores/auth'
    import {computed} from "vue";
    const store = useAuthStore()

    /**
     * State
     */
    const name = store.getName
    const count = store.getCount

    /**
     * Getter
     */
    const doubleValue = computed(() => store.doubleCount)
    const idea = computed(() => store.getIdea)

    /**
     * Actions
     */
    const action = store.increment;


</script>
<template>
  <div class="about">
    <h1>This is an about page {{ name }} = {{ doubleValue }} = {{ idea }} </h1>
      <input v-model="idea.first_name">
      <input v-model="idea.last_name">
      <button @click="action">Test</button>
  </div>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
