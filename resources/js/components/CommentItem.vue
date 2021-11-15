<template>
  <div>
    <div class="row d-flex justify-content-center mt-100 mb-100">
      <div class="col-lg-50">
        <div class="card">
          <div class="card-body text-center"></div>
          <div class="comment-widgets">
            <!-- Comment Row -->
            <div class="d-flex flex-row comment-row m-t-0">
              <div class="p-2">
                <img
                  src="https://i.imgur.com/Ur43esv.jpg"
                  alt="user"
                  width="50"
                  class="rounded-circle"
                />
              </div>
              <div class="comment-text w-100">
                <h6 class="font-medium">{{ comment.user.name }}</h6>
                <span class="m-b-15 d-block">{{ comment.comment }} </span>

                <div v-if="comment.user_id == loginuser" class="comment-footer">
                  <!-- Button trigger modal -->
                  <button
                    @click="openUpdateComment()"
                    type="button"
                    class="btn btn-cyan btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    id="editBtn"
                  >
                    Edit..
                  </button>
                  <button
                    type="button"
                    @click="deleteComment()"
                    class="btn btn-danger btn-sm"
                  >
                    Delete
                  </button>

                  <!-- Modal -->
                </div>
                <span class="text-muted float-right">{{ comment.created_at }}</span>
              </div>
            </div>
            <!-- Comment Row -->

            <!-- Comment Row -->
            <div
              class="modal fade"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
              id="modalBox"
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
                    <input type="text" id="updateComment" value="댓글을 입력해 주세요." />
                  </div>

                  <div class="modal-footer">
                    <button @click="updateComment()" class="btn btn-primary" id="saveBtn">
                      update comment

                      {{ comment.id }}
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
            <!-- Card -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["comment", "getget", "getPage", "loginuser"],

  data() {
    return {};
  },
  mounted() {
    console.log(this.comment.id);

    document.getElementById("modalBox").setAttribute("id", "modalBox" + this.comment.id);

    document.getElementById("editBtn").setAttribute("id", "editBtn" + this.comment.id);
    document
      .getElementById("updateComment")
      .setAttribute("id", "updateComment" + this.comment.id);
  },

  methods: {
    // childzzz(){     this.$parent.zzzz(); },
    deleteComment() {
      axios
        .delete("/commentDelete/" + this.comment.id)
        .then((res) => {
          console.log("삭제완료 두번누르면에러남");
          this.getget();
          swal({
            title: "delete",
          });
          //어떻게 댓글 껍데기 지우기 ㅇㅇ
        })
        .catch();
    },

    updateComment() {
      axios
        .put("/commentUpdate/" + this.comment.id, {
          commentInfo: document.getElementById("updateComment" + this.comment.id).value,
        })
        .then((res) => {
          $("#modalBox" + this.comment.id).modal("hide");
          this.getget();
        })
        .catch((err) => {});
    },

    openUpdateComment() {
      $("#editBtn" + this.comment.id).on("click", () => {
        $("#modalBox" + this.comment.id).modal("show");

        $("#modalBox").on("shown.bs.modal", function () {
          $("#modalBox").focus();
        });
      });
    },
  },
};

//질문할거..
//1. jquery 로 $(id).on("click") 이후 함수배정하나 버튼에 @click 해서 js에서 함수만드나 같은거아닌가.

// 2. 자식컴퍼넌트에서 모달만들고 부모에서 리스트 랜더링하니까 자식컴퍼넌트의 모달id가 중복되서 많이생겨서 제일 첫번째 컴퍼넌트의 댓글만
// 변경되던데,  document      .getElementById("editBtn")  .setAttribute("id",
// "editBtn" + this.comment.id); 이렇게 컴퍼넌트에서 변동이필요한 html태그마다 id붙이니까 너무 비효율적인것 같다.
// 어떤방식이좋을까
//
//3. 같은 blade.php 파일 내에서 부모뷰, 자식뷰 여러개 있는데 부모뷰에서 쓰는 id를 자식뷰에서 쓰면 꼬일까???
//
//4. 글-댓 idㅋㅋ
</script>

<style lang="scss">
.modalBox {
  z-index: 1;
}
</style>
