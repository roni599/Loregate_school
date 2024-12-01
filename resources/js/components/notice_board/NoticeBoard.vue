<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Notice-Board</span>
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
        <div v-if="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Notice Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="inputDate">Date</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input v-model="form.date" class="form-control" id="inputDate" type="date"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputReference">Reference</label>
                                    <select v-model="form.reference" class="form-select p-3" required>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputSubject">Subject</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input v-model="form.subject" class="form-control" id="inputSubject" type="text"
                                            required />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="inputDescription">Description</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <textarea v-model="form.description" class="form-control p-3 px-4"
                                            id="inputDescription" rows="5" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-11">
                                    <label for="inputFile">Signature</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input ref="fileInput" @change="onFileSelect" class="form-control p-3 px-4"
                                            id="inputFile" type="file" />
                                    </div>
                                </div>
                                <div class="col-md-1 mt-4">
                                    <img v-if="form.image" :src="form.image" width="55" height="55" />
                                </div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                    <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                        aria-hidden="true"></span>
                                    <span v-if="!loading">Edit Notice-Board</span>
                                    <span v-if="loading">Editing Notice-Board...</span>
                                </button>
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
import { ref, shallowRef, markRaw, reactive } from 'vue';
import NoticeBoardList from './NoticeBoardList.vue';
export default {
    components: {
        NoticeBoardList,
    },
    setup() {
        const loading = ref(false);
        const currentComponent = shallowRef(null);

        const form = reactive({
            date: '',
            reference: '',
            subject: '',
            description: '',
            image: null,
        });

        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                alert("Image must be less than 1 MB!");
            } else {
                let reader = new FileReader();
                reader.onload = (e) => {
                    form.image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const submitForm = async () => {
            loading.value = true;
            let formData = new FormData();
            formData.append('date', form.date);
            formData.append('reference', form.reference);
            formData.append('subject', form.subject);
            formData.append('description', form.description);
            formData.append('signature', form.image);
            try {
                const response = await axios.post('/api/academy/notice-boards', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                if (response.data) {
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
            form.date = '';
            form.reference = '';
            form.subject = '';
            form.description = '';
            form.image = null;
        };

        const componentLoad = () => {
            currentComponent.value = markRaw(NoticeBoardList);
        };
        const anotherLoad = () => {
            currentComponent.value = null;
        };

        return {
            loading,
            currentComponent,
            anotherLoad,
            componentLoad,
            onFileSelect,
            submitForm,
            form,
            resetForm
        }
    }
}
</script>

<style></style>