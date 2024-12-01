<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> / Board-News</span>
            </div>
        </div>

        <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2 mb-3">
                <div>
                    <button @click="componentLoad" class="btn btn-info px-5">List</button>
                </div>
                <div>
                    <button @click="anotherLoad" class="btn btn-info px-5">Create</button>
                </div>
            </div>

        <div v-show="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Board-News Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputName">Heading</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" v-model="form.heading" type="text"
                                            placeholder="Enter your name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputDate">Date</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputDate" v-model="form.date" type="date" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputWriter">Writer</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputWriter" v-model="form.writer" type="text"
                                            placeholder="Writer" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputDataSources">Data Sources</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputDataSources" v-model="form.data_sources"
                                            type="text" placeholder="Data Sources" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="inputDescription">Description</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <textarea class="form-control" id="inputDescription" v-model="form.description"
                                            rows="4" placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Board-News</span>
                                        <span v-if="loading">Editing Board-News...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent"></component>
</template>

<script>
import { ref, shallowRef, markRaw } from 'vue';
import BoardnewstList from './BoardnewstList.vue';
export default {
    components:{
        BoardnewstList
    },
    setup() {
        const currentComponent = shallowRef(null);
        const loading = ref(false)
        const form = ref({
            heading: "",
            date: "",
            writer: "",
            data_sources: "",
            description: "",
        });

        const componentLoad = () => {
            currentComponent.value = markRaw(BoardnewstList)
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }


        const submitForm = async () => {
            loading.value = true;

            try {
                const response = await axios.post("/api/academy/boardnews", form.value);
                if (response.data) {
                    resetForm();
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: error.response?.data?.message || 'An error occurred',
                });
            } finally {
                loading.value = false;
            }
        };

        const resetForm = () => {
            form.value = {
                heading: "",
                date: "",
                writer: "",
                data_sources: "",
                description: "",
            };
        };


        return {
            loading,
            form,
            submitForm,
            resetForm,
            currentComponent,
            componentLoad,
            anotherLoad
        }
    }
}
</script>

<style></style>