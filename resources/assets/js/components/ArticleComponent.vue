<template>
    <div>
        
        <template>
            <div>
                <b-button class= "mb-2" variant="primary" @click="showModal">
                    Add Record
                </b-button>
                
                <b-modal ref="myModalRef" hide-footer title="Record Update">
                    <div class="d-block">
                        <h3>Add Record</h3>
                        <b-form class="mb-3" @submit.prevent="addArticle" @reset="onReset">
                            <b-form-group id="exampleInputGroup1"
                                            label="Name"
                                            label-for="exampleInput1">
                                <b-form-input id="exampleInput1"
                                                type="text"
                                                v-model="article.name"
                                                required
                                                placeholder="Enter Title">
                                </b-form-input>
                            </b-form-group>
                            <b-form-group id="exampleInputGroup2"
                                            label="Description"
                                            label-for="exampleTextArea1">
                                <b-form-textarea id="exampleTextArea1"
                                                
                                                    v-model="article.description"
                                                    required
                                                    placeholder="Enter description">
                                </b-form-textarea>
                            </b-form-group>
                            <b-form-group id="exampleInputGroup3"
                                            label="Status"
                                            label-for="exampleRadio">
                                <b-form-radio-group id="exampleRadio"
                                                
                                                    v-model="article.status"
                                                    required
                                                    placeholder="Choose status"
                                                    name="radioSubComponent">
                                                    <b-form-radio value="active">Active</b-form-radio>
                                                    <b-form-radio value="inactive">Inactive</b-form-radio>
                                </b-form-radio-group>
                            </b-form-group>
                        <b-button type="submit" variant="primary">Save Record</b-button>
                        <b-button type="reset" variant="warning">Reset</b-button>
                        </b-form>
                    </div>
                    <b-btn variant="secondary" block @click="hideModal">Cerrar</b-btn>
                </b-modal>
            </div>
        </template>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="[{disabled: !pagination.prev_page_url}]">
                    <a @click="fetchArticles(pagination.prev_page_url)" 
                    href="#" class="page-link">Previous</a>
                </li>
                <li class="page-item disabled"><a href="#" class="page-link text-dark">
                    Page {{ pagination.current_page }} of {{pagination.last_page}}</a>
                </li>
                <li class="page-item" :class="[{disabled: !pagination.next_page_url}]">
                    <a @click="fetchArticles(pagination.next_page_url)" href="#" 
                    class="page-link">Next</a>
                </li>
            </ul>
        </nav>
        <div class="card card-body mb-2" v-for="article in articles" :key="article.id">
            <h3>{{article.name}}</h3>
            <p>{{article.description}}</p>
            <h4>Status: {{article.status}}</h4>
            <hr>
            <b-button @click="editArticle(article)" class="btn btn-info mb-2">Edit</b-button>
            <b-button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</b-button>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      article: {
        id: "",
        name: "",
        description: "",
        status: "inactive"
      },
      article_id: "",
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || "/api/articles";
      axios
        .get(page_url)
        .then(res => {
          this.articles = res.data.data;
          vm.makePagination(res.data.meta, res.data.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
        total: meta.total
      };
      this.pagination = pagination;
    },
    deleteArticle(id) {
      if (confirm("Are You Sure?")) {
        axios
          .delete(`api/article/${id}`)
          .then(res => {
            console.log(res);
            alert("Article Removed");
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    addArticle() {
      if (this.edit === false) {
        // Add
        console.log("attempting to POST....");
        
        this.article.id= "";
        fetch('api/article', {
          method: 'post',
          body: JSON.stringify({
            id: "",
        name: this.article.name,
        description: this.article.description,
        status: this.article.status
          }),
          headers: {
            'content-type': 'application/json'
          }
        })
        .then(res=> {
          res.json(); 
          console.log(res.json);
          
        })
        .then(data=>{
          this.article.name = "";
            this.article.description = "";
            this.article.status = "inactive";
            alert("Article Added");
            this.fetchArticles();
        })
        .catch(function(error) {
            console.log(error);
          });


        // axios
        //   .post("api/article", this.article)
        //   .catch(function(error) {
        //     console.log(error);
        //   })
        //   .then(res => {
        //     console.log(res);

        //     this.article.name = "";
        //     this.article.description = "";
        //     this.article.status = "inactive";

        //     alert("Article Added");
        //     this.fetchArticles();
        //   });
      } else {
        axios
          .put("api/article", this.article)
          .then(res => {
            console.log(res);

            this.article.name = "";
            this.article.description = "";
            this.article.status = "inactive";
            this.edit = false;
            alert("Article Updated");
            this.fetchArticles();
          })
          .catch(function(error) {
            console.log(error);
          });
      }
      this.hideModal();
    },
    editArticle(article) {
      this.edit = true;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.name = article.name;
      this.article.description = article.description;
      this.article.status = article.status;
      this.showModal();
    },
    onReset() {
      this.article.name = "";
      this.article.description = "";
      this.article.status = "inactive";
    },
    showModal() {
      this.$refs.myModalRef.show();
    },
    hideModal() {
      this.$refs.myModalRef.hide();
    }
    
  }
};
</script>