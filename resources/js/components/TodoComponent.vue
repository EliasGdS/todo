<template>
  <div class="w-75">
    <form-todo-component></form-todo-component>
    <todo-list-component></todo-list-component>
  </div>
</template>

<script>
import TodoListComponent from "./TodoListComponent";
import FormTodoComponent from "./FormTodoComponent";

export default {
  components: {
    TodoListComponent,
    FormTodoComponent,
  },
};
</script>

<style scoped>
</style>>
