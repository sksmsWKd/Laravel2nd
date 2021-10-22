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
                <h6 class="font-medium">James Thomas</h6>
                <span class="m-b-15 d-block">{{ comment.comment }} </span>
                <div class="comment-footer">
                  <span class="text-muted float-right">April 14, 2019</span>
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
                    {{ comment.id }}
                    Delete
                  </button>

                  <!-- Modal -->
                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">
                      Modal title
                    </h5>
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
                      id="updateComment"
                      value="댓글을 입력해 주세요."
                    />
                  </div>
                  <div class="modal-footer">
                    <button
                      @click="updateComment()"
                      class="btn btn-primary"
                      id="saveBtn"
                    >
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
  props: ["comment"],

  mounted() {
    console.log(this.comment.id);
    document
      .getElementById("modalBox")
      .setAttribute("id", "modalBox" + this.comment.id);

    document
      .getElementById("editBtn")
      .setAttribute("id", "editBtn" + this.comment.id);
    document
      .getElementById("updateComment")
      .setAttribute("id", "updateComment" + this.comment.id);
  },

  methods: {
    deleteComment() {
      axios
        .delete("/commentDelete/" + this.comment.id)
        .then((res) => {
          console.log(this.comment.id);
          console.log("삭제완료 두번누르면에러남");
        })
        .catch();
    },

    updateComment() {
      axios
        .put("/commentUpdate/" + this.comment.id, {
          commentInfo: document.getElementById(
            "updateComment" + this.comment.id
          ).value,
        })
        .then((res) => {
          console.log(res);
          console.log(this.comment.id);
          $("#modalBox" + this.comment.id).modal("hide");

          console.log(res.data);
        })
        .catch((err) => {});
    },

    openUpdateComment() {
      $("#editBtn" + this.comment.id).on("click", () => {
        $("#modalBox" + this.comment.id).modal("show");
      });
    },
    getComments() {
      axios
        .get("/commentlist")
        .then((res) => {
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};

//질문할거..
//1. jquery 로 $(id).on("click") 이후 함수배정하나
//버튼에 @click 해서 js에서 함수만드나 같은거아닌가.

//2. 자식컴퍼넌트에서 모달만들고
//부모에서 리스트 랜더링하니까 자식컴퍼넌트의 모달id가
//중복되서 많이생겨서 제일 첫번째 컴퍼넌트의 댓글만
// 변경되던데,
//  document
//      .getElementById("editBtn")
//  .setAttribute("id", "editBtn" + this.comment.id);
// 이렇게 컴퍼넌트에서 변동이필요한 html태그마다
// id붙이니까 너무 비효율적인것 같다. 어떤방식이좋을까
//
//3. 같은 blade.php 파일 내에서
// 부모뷰, 자식뷰 여러개 있는데
// 부모뷰에서 쓰는 id를 자식뷰에서 쓰면
// 꼬일까???
//
//4. 글id 맞는댓글만 나오게 해야함 해결할것. 시험끝나고하던지
</script>

