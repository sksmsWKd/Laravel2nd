<template>
  <div>
    asdasd
    <button @click="getComments()" class="btn btn-primary">
      댓글 불러오기
    </button>
    <comment-item
      v-for="(comment, index) in comments"
      :key="index"
      :comment="comment"
    ></comment-item>
  </div>
</template>
<script>
import CommentItem from "./CommentItem.vue";
export default {
  components: { CommentItem },
  data() {
    return {
      comments: [],
    };
  },
  props: ["post", "loginuser"],
  methods: {
    getComments() {
      this.comments = ["1st", "2nd", "3rd", "4th", "5th"];
    },
  },
};
</script>