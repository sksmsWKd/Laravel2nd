<template>
  <div id="cboxc">
    <div>
      <button @click="getComments()" class="btn btn-primary">
        댓글 불러오기 글번호
        {{ post.id }}
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
              <input
                type="text"
                id="modalInput"
                value="댓글을 입력해 주세요."
                v-model="comment"
              />
            </div>
            <div class="modal-footer">
              <button @click="saveComment()" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
      <comment-item
        v-for="(comment, id) in comments.data"
        :key="id"
        :comment="comment"
        :getget="getComments"
        :loginuser="loginuser"
      ></comment-item>

      <pagination
        @pageClicked="getPage($event)"
        v-if="comments.data != null"
        :links="comments.links"
      />
    </div>
  </div>
</template>
<script>
import CommentItem from "./CommentItem.vue";
import Pagination from "./Pagination.vue";
export default {
  components: {
    CommentItem,
    Pagination,
  },

  data() {
    return { comments: [], comment: "" };
  },

  props: ["post", "loginuser"],

  methods: {
    getPage(url) {
      axios
        .get(url)
        .then((res) => {
          this.comments = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getComments() {
      axios
        .get("/commentlist/" + this.post.id)
        .then((res) => {
          this.comments = res.data;
          console.log(this.comments.data);
        })
        .catch((err) => {
          console.log(err);
        });
      // 서버에 현재 게시글의 댓글 리스트를 비동기적으로 요청 즉 ,axios 를 이용해서 요청 서버가 댓글 리스트 주면 ,
      // this.comments 에 할당.
    },

    openWriteComment() {
      $("#openModalBtn").on("click", function () {
        $("#modalBox0").modal("show");
      });
    },

    saveComment() {
      axios
        .post("/commentSave/" + this.post.id, { comment: this.comment })
        .then((res) => {
          this.getComments();
          this.comment = "";
          $("#modalBox0").modal("hide");
        })
        .catch((err) => {
          console.log(err);
        });
    },
    zzzz() {
      alert("goodnight");
    },
  },
};
</script>
<style>
#cboxc {
  position: sticky;
  top: 0;
}
</style>
