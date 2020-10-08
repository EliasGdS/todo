<template>
  <form action="post">
    <div class="input-group mb-3">
      <input
        type="text"
        v-bind:class="[
          'form-control form-control-lg',
          { 'is-invalid': errors.task },
        ]"
        placeholder="Título da Tarefa"
        aria-label="Título da Tarefa"
        aria-describedby="basic-addon2"
        v-model="form.task"
      />
      <div class="input-group-append">
        <button
          class="btn btn-green"
          type="button"
          id="basic-addon2"
          @click="createTask"
        >
          <span class="btn-text">Criar Tarefa</span>
        </button>
      </div>
      <div v-for="(error, id) in errors" :key="id" class="invalid-tooltip">
        {{ error[0] }}
      </div>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        task: "",
      },
      errors: {},
    };
  },

  methods: {
    createTask() {
      this.$store
        .dispatch("createTask", this.form)
        .then(() => {
          this.$store.dispatch("loadTasks");
          this.form.task = "";
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(error.response.data.errors);
        })
        .finally(() => {});
    },
  },
};
</script>

<style scoped>
.btn-green {
  background-color: #50fa7b;
}

.btn-green:hover {
  background-color: #43d467;
}

.btn-text {
  color: #000000;
  font-weight: 400;
  font-size: 18px;
}
</style>>
