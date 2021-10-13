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
                <span class="m-b-15 d-block"
                  >This is awesome website. I would love to comeback again.
                </span>
                <div class="comment-footer">
                  <span class="text-muted float-right">April 14, 2019</span>
                  <button type="button" class="btn btn-cyan btn-sm">
                    Edit
                  </button>
                  <button type="button" class="btn btn-success btn-sm">
                    Publish
                  </button>
                  <button type="button" class="btn btn-danger btn-sm">
                    Delete
                  </button>
                </div>
              </div>
            </div>
            <!-- Comment Row -->

            <!-- Comment Row -->

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
};
</script>