<template>
  <div class="row">
      <div
      v-for="(task, id) in tasks"
      :key="id"
      class="d-flex col-md-6 box p-3 bg-white mb-1"
    >
      <span class="mr-2">
        <svg
          v-on:click="toggleTodo(task)"
          v-if="task.completed == false"
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-circle"
          width="25"
          height="25"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="#ff79c6"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <circle cx="12" cy="12" r="9" />
        </svg>

        <svg
          v-on:click="toggleTodo(task)"
          v-if="task.completed == true"
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-circle-check"
          width="25"
          height="25"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="#3fd163"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <circle cx="12" cy="12" r="9" />
          <path d="M9 12l2 2l4 -4" />
        </svg>
      </span>

      <div class="font-weight-bolder">
        <span
          v-if="editmode == false || editmode != task.id"
          :class="{ 'line-through': task.completed }"
        >
          {{ task.task }}</span
        ><input
          class="form-control"
          v-if="editmode == task.id"
          v-model="task.task"
          type="text"
        />
      </div>

      <div class="ml-auto mr-2 d-flex align-items-center">
        <span>
          <svg
            v-on:click="editmode = task.id"
            v-if="editmode != task.id"
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-pencil"
            width="25"
            height="25"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="#bd93f9"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" />
            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5" />
          </svg>

          <svg
            v-if="editmode == task.id"
            v-on:click="updateTask(task)"
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-check"
            width="25"
            height="25"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="#3fd163"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 12l5 5l10 -10" />
          </svg>

          <svg
            v-on:click="destroyTask(task)"
            xmlns="http://www.w3.org/2000/svg"
            class="icon icon-tabler icon-tabler-trash"
            width="25"
            height="25"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="#ff5555"
            fill="none"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="4" y1="7" x2="20" y2="7" />
            <line x1="10" y1="11" x2="10" y2="17" />
            <line x1="14" y1="11" x2="14" y2="17" />
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
          </svg>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      editmode: false,
      form: {
        task: "edt",
      },
    };
  },

  mounted() {
    this.loadTasks();
  },

  computed: {
    tasks() {
      return _.orderBy(this.$store.state.todos.tasks.data, "id");
    },
  },

  methods: {
    loadTasks() {
      this.$store.dispatch("loadTasks");
    },

    toggleTodo(task) {
      task.completed = !task.completed;
      this.updateTask(task);
    },

    updateTask(task) {
      this.editmode = false;
      this.$store
        .dispatch("updateTask", task)
        .then(() => {
          this.loadTasks();
        })
        .catch((error) => {});
    },

    destroyTask(task) {
      this.$store
        .dispatch("destroyTask", task.id)
        .then(() => {
          this.loadTasks();
        })
        .catch(() => {});
    },
  },
};
</script>

<style scoped>
.line-through {
  text-decoration: line-through;
}

.row{
  margin-left: 0;
  margin-right: 0;
}

.box{
  border: 3px solid transparent;
  border-radius: 10px;
  background-clip: padding-box;
  box-model: border-box;
}
</style>