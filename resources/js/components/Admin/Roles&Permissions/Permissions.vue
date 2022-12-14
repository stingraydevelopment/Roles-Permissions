<template>
  <div>

    <div v-if="displayForm == false" class="wrapper">

      <div class="row">

        <div class="col-md-8">
          <div class="form-group">
            <input
              id="filter"
              class="form-control"
              type="text"
              placeholder="Enter name here..."
              v-model="search"
              @keyup="filter"
            />
            <p class="help-block"></p>
          </div>
        </div>

        <div class="col-md-4">
          <p>
            <span class="float-end">
              <button class="btn btn-outline-info" @click="open"><i class="bi bi-pencil-fill"></i> Create New Permission</button>
            </span>
          </p>
        </div>

      </div>

      <div class="permissions-wrapper">

        <div class="row table-header">

          <div class="col-md-3">
              <strong>Name</strong>
          </div>

          <div class="col-md-8">
              <strong>Description</strong>
          </div>

          <div class="col-md-1">
              <!-- Options -->
          </div>

        </div>

        <div v-for="permission in permissions" :key="permission.id" class="permission">

          <div class="row">

            <div class="col-md-3">
                <strong>{{ permission.name }}</strong>
            </div>

            <div class="col-md-8">
                <em>{{ permission.description }}</em>
            </div>

            <div class="col-md-1">
                <button class="btn btn-sm btn-outline-info" @click="select(permission)"><i class="bi bi-pencil"></i> Edit</button>
            </div>

          </div>

        </div>

      </div>

      

    </div>

    <div v-if="displayForm == true" class="form">

      <p>
        <button @click="close" class="btn-close float-end"></button>
      </p>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input
              id="name"
              class="form-control"
              type="text"
              placeholder="Enter Name here..."
              v-model="active.name"
            />
            <p class="help-block"></p>
          </div>

          <div v-if="updateModel" class="form-group">
            <label for="slug">Slug</label>
            <input
              id="slug"
              class="form-control"
              type="text"
              placeholder="Enter Slug here..."
              v-model="active.slug"
            />
            <p class="help-block"></p>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea
              id="description"
              class="form-control"
              type="text"
              rows="10"
              placeholder="Enter Description here..."
              v-model="active.description"
            ></textarea>
            <p class="help-block"></p>
          </div>
        </div>

        <div class="col-md-6">
          
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <button v-if="updateModel == false" @click="insert" class="btn btn-outline-info ms-2"><i class="bi bi-check-square"></i> Save</button>
          <button v-if="updateModel == true" @click="update" class="btn btn-outline-info ms-2"><i class="bi bi-check-square"></i> Update</button>
          <button
            v-if="updateModel == true"
            @click="remove"
            class="btn btn-outline-danger float-end"
          ><i class="bi bi-trash"></i> Delete</button>
        </div>
      </div>

    </div>

  </div>
</template>

<script>
export default {
  created() {
    this.get();
  },
  data: () => ({
    active: {},
    search: null,
    displayForm: false,
    permissions: [],
    updateModel: false
  }),
  methods: {
    close() {
      this.displayForm = false;
      this.updateModel = false;
      this.active = null;
    },
    remove() {
      let answer = confirm(
        "Are you sure you wish to remove this permission from the system?"
      );
      if (answer == true) {
        axios.post("/api/v1/admin/permission/delete", this.active).then(response => {
          this.permissions = response.data;
          this.close();
        });
      }
    },
    filter() {
      let post = {
        filter: this.search
      };
      axios.post("/api/v1/admin/permission/filter", post).then(response => {
        this.permissions = response.data;
      });
    },
    get() {
      axios.get("/api/v1/admin/permission/get").then(response => {
        this.permissions = response.data;
      });
    },
    insert() {
      if (this.validate) {
        axios.post("/api/v1/admin/permission/insert", this.active).then(response => {
          this.permissions = response.data;
          this.close();
        });
      }
    },
    open() {
      this.active = {};
      this.displayForm = true;
    },
    select(model) {
      this.active = model;
      this.displayForm = true;
      this.updateModel = true;
    },
    update() {
      axios.post("/api/v1/admin/permission/update", this.active).then(response => {
        this.permissions = response.data;
        this.close();
      });
    },
    validate() {
      if (!this.active.email || !this.active.password) {
        alert("You must have an email and password.");
        return false;
      }
      return true;
    }
  }
};
</script>

<style scoped>
  .form {
      border: 1px solid #ededed;
      clear: both;
      padding: 15px;
  }

  .permissions-wrapper {
      border: 1px solid lightgray;
  }

  .permission {
      border: none;
      display: block;
      margin: 1px 0;
      padding: 10px;
      width: 100%;
  }

  .permission:nth-child(odd) {
      background: white;
  }

  .permission:nth-child(even) {
      background: #efefef;
  }

  .profile-pic {
      height: 25px;
      border-radius: 50%;
  }

  .btn-sm {
      padding: 1px 5px;
      float: right;
  }

  .wrapper {
      background: #FFF;
      padding: 15px;
  }

  @media screen and (max-width: 767px) {

    .btn-sm {
        margin-top: 10px;
        float: none;
    }

    .form {
      padding: 5px;
    }

    .permission {
        padding-bottom: 10px;
    }

    .profile-pic {
        width: 100%;
        max-width: 200px;
        height: auto;
        margin: 0 auto;
        display: block;
    }

    .wrapper {
    background: #FFF;
    padding: 5px;
    }
  }
</style>