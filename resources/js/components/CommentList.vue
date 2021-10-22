<template>
  <div>
    <button @click="getComments()" class="btn btn-primary">
      댓글 불러오기
    </button>
    <!-- Button trigger modal -->

    <button
      @click="openWriteComment()"
      type="button"
      class="btn btn-primary"
      id="openModalBtn"
      data-bs-toggle="modal"
      data-bs-target="#exampleModal"
    >
      Write Comment
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modalBox0"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <input type="text" id="commentBody" value="댓글을 입력해 주세요." />
          </div>
          <div class="modal-footer">
            <button @click="saveComment()" class="btn btn-primary" id="saveBtn">
              Save changes
            </button>
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <comment-item
      v-for="(comment, index) in commentlist"
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
      commentlist: [],
    };
  },
  // created() {
  //   this.getComments();
  // },

  props: ["post", "loginuser", "comments"],

  methods: {
    getComments() {
      axios
        .get("/commentlist")
        .then((res) => {
          // console.log(res.data);
          this.commentlist = this.comments;
        })
        .catch((err) => {
          console.log(err);
        });

      // 서버에 현재 게시글의 댓글 리스트를 비동기적으로 요청
      // 즉 ,axios 를 이용해서 요청
      // 서버가 댓글 리스트 주면 , this.comments 에 할당.
    },

    openWriteComment() {
      $("#openModalBtn").on("click", function () {
        $("#modalBox0").modal("show");
      });
    },

    saveComment() {
      $("#saveBtn").on("click", () => {
        console.log(document.getElementById("commentBody").value);

        $("#modalBox").modal("hide");
        axios
          .post("/commentSave/" + this.post.id, {
            comment: document.getElementById("commentBody").value,
          })
          .then((res) => {
            // console.log(res.data);
            this.getComments();
            console.log(this.commentlist);
          })
          .catch((err) => {
            console.log(err);
          });
      });
    },
  },
};
</script>