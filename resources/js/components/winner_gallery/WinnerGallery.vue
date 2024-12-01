<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-2">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link><span
                    class="text-muted h5"> /
                    Winner-Gallery</span>
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
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">winner-gallery Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" @submit.prevent="submitForm">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="eventName">Event Name</label>
                                    <input class="form-control" id="eventName" v-model="form.event_name" type="text"
                                        placeholder="Enter event name" />
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" v-model="form.name" type="text"
                                        placeholder="Enter name" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="class">Class</label>
                                    <input class="form-control" id="class" v-model="form.class" type="text"
                                        placeholder="Enter class" />
                                </div>
                                <div class="col-md-6">
                                    <label for="rollOrUid">Roll/UID</label>
                                    <input class="form-control" id="rollOrUid" v-model="form.roll_or_uid" type="text"
                                        placeholder="Enter roll/UID" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="winningPlace">Winning Place</label>
                                    <input class="form-control" id="winningPlace" v-model="form.winning_place"
                                        type="text" placeholder="Enter winning place" />
                                </div>
                                <div class="col-md-6">
                                    <label for="price">Price</label>
                                    <input class="form-control" id="price" v-model="form.price" type="text"
                                        placeholder="Enter price" />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-11 mb-2">
                                    <label for="image">Upload Picture</label>
                                    <input class="form-control" id="image" type="file" @change="onFileSelect" />
                                </div>
                                <div class="col-md-1 mt-4">
                                    <img v-if="imagePreview" :src="imagePreview" width="55" height="55" />
                                </div>
                            </div>
                            <div class="mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Edit winner-gallery</span>
                                        <span v-if="loading">Editing winner-gallery...</span>
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
import { ref, reactive, shallowRef, markRaw } from 'vue';
import WinnergalleryList from './WinnergalleryList.vue';

export default {
    components: {
        WinnergalleryList
    },
    setup() {
        const loading = ref(false)
        const currentComponent = shallowRef(null);

        const form = reactive({
            event_name: '',
            name: '',
            class: '',
            roll_or_uid: '',
            winning_place: '',
            price: '',
            image: null,
        });
        const imagePreview = ref(null);

        const componentLoad = () => {
            currentComponent.value = markRaw(WinnergalleryList)
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }


        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!"
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    form.image = e.target.result;
                    imagePreview.value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const submitForm = async () => {
            loading.value = true;

            const formData = new FormData();
            for (let key in form) {
                formData.append(key, form[key]);
            }

            try {
                const response = await axios.post('/api/academy/winnergallery', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                if (response.status === 200) {
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
            form.event_name = '';
            form.name = '';
            form.class = '';
            form.roll_or_uid = '';
            form.winning_place = '';
            form.price = '';
            form.image = null;
            imagePreview.value = null;
        };

        return {
            loading,
            componentLoad,
            currentComponent,
            anotherLoad,
            form,
            imagePreview,
            submitForm,
            onFileSelect
        }
    }
}
</script>

<style></style>