<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> / Magazine</span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2">
                <div>
                    <button @click="componentLoad" class="btn btn-info px-5">List</button>
                </div>
                <div>
                    <button @click="anotherLoad" class="btn btn-info px-5">Create</button>
                </div>
            </div>
        </div>
        <div v-show="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Magazine Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" @submit.prevent="storeMagazine">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="subject">Subject</label>
                                    <select class="form-select p-3" v-model="subject">
                                        <option value="" disabled selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName">Heading</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputName" type="text" v-model="heading"
                                            placeholder="Enter your name" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputSalary">Writer</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSalary" type="text" v-model="writer"
                                            placeholder="Writer" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputSalary">Data Sources</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSalary" type="text" v-model="dataSources"
                                            placeholder="Data Sources" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="inputAddress">Description</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <textarea class="form-control" id="inputAddress" v-model="description" rows="4"
                                            placeholder="Enter academy address"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputSalary">Date</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputSalary" type="date" v-model="date"
                                            placeholder="Date" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit Magazine</span>
                                        <span v-if="loading">Editing Magazine...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent" />
</template>

<script>
import { ref, shallowRef, markRaw } from 'vue';
import MagazineList from './MagazineList.vue';
export default {
    components: {
        MagazineList,
    },
    setup() {
        const loading = ref(false)
        const subject = ref('');
        const heading = ref('');
        const writer = ref('');
        const dataSources = ref('');
        const description = ref('');
        const date = ref('');
        const currentComponent = shallowRef(null);

        const componentLoad = () => {
            currentComponent.value = markRaw(MagazineList);
        };
        const anotherLoad = () => {
            currentComponent.value = null;
        };

        const storeMagazine = async () => {
            const formData = new FormData();
            formData.append('subject', subject.value);
            formData.append('heading', heading.value);
            formData.append('writer', writer.value);
            formData.append('data_sources', dataSources.value);
            formData.append('description', description.value);
            formData.append('date', date.value);

            try {
                loading.value = true;
                const response = await axios.post('/api/academy/magazine/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });
                if (response.data.data) {
                    resetForm();
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: error.response?.data?.message || 'An error occurred',
                });
            } finally {
                loading.value = false;
            }
        };

        const resetForm = () => {
            subject.value = '';
            heading.value = '';
            writer.value = '';
            dataSources.value = '';
            description.value = '';
            date.value = '';
        };
        return {
            subject,
            heading,
            writer,
            dataSources,
            description,
            date,
            loading,
            storeMagazine,
            currentComponent,
            componentLoad,
            anotherLoad,
            resetForm
        }
    }
}
</script>

<style></style>