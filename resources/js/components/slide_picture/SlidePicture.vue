<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p><i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Slide-Picture Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="handleSubmit" enctype="multipart/form-data" class="py-5">
                            <div v-for="(image, index) in images" :key="index" class="row mb-4 align-items-center">
                                <div class="col-md-10">
                                    <label :for="'inputFile' + index">Sliding Picture {{ index + 1 }}</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input :id="'inputFile' + index" type="file" class="form-control p-3 px-4"
                                            @change="onFileSelect($event, index)" />
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <img :src="image.preview" v-if="image.preview" width="55" height="55" />
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm"
                                        :class="index === 0 ? 'btn-primary' : 'btn-danger'"
                                        @click="index === 0 ? addImageField() : removeImageField(index)">
                                        <i :class="index === 0 ? 'fas fa-plus' : 'fas fa-minus'"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading.value">
                                        <span v-if="loading.value" class="spinner-border spinner-border-sm me-2"
                                            role="status" aria-hidden="true"></span>
                                        <span v-if="!loading.value">Update Slide-Picture</span>
                                        <span v-if="loading.value">Updating Slide-Picture...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const images = reactive([{ file: null, preview: null }]);
        const form = reactive({
            images: []
        });
        const loading = ref(false);
        const academy_id = ref(null);

        const onFileSelect = (event, index) => {
            const file = event.target.files[0];
            if (file && file.size <= 1048576) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    images[index].preview = event.target.result;
                    form.images[index] = event.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert("Image must be less than 1 MB!");
            }
        };

        const addImageField = () => {
            if (images.length < 3) {
                images.push({ file: null, preview: null });
            } else {
                alert("Only up to 3 image input fields are allowed.");
            }
        };

        const removeImageField = async (index) => {
            if (index !== 0) {
                const imageFilename = form.images[index];
                const academy_id = 8;

                try {
                    const response = await axios.post('/api/academy/slidepicture/delete', {
                        image: imageFilename,
                        academy_id: academy_id
                    });
                    if (response) {
                        loadSlideImages()
                        images.splice(index, 1);
                        form.images.splice(index, 1);
                    }
                } catch (error) {
                    console.error('Error deleting image:', error);
                }
            }
        };



        const handleSubmit = async () => {
            console.log(form.images)
            if (!form.images.length) {
                alert("At least one image input field is required.");
                return;
            }
            const formData = new FormData();
            form.images.forEach((image, index) => {
                formData.append(`images[${index}]`, image);
            });
            const update_id = 8;
            formData.append('academy_id', update_id);
            try {
                loading.value = true;
                const response = await axios.post('/api/academy/slidepicture/store', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                });
                console.log(response);
            } catch (error) {
                console.error('Error uploading images:', error);
            } finally {
                loading.value = false;
            }
        };

        // const handleSubmit = async () => {
        //     if (!form.images.length) {
        //         alert("At least one image input field is required.");
        //         return;
        //     }
        //     console.log(form.images.length)

        //     if (form) {
        //         for (let i = 0; i <= form.images.length; i++) {
        //             const picturePath = `/backend/images/slidepicture/${form.images[i]}`;
        //             const imageResponse = await fetch(picturePath);
        //             const imageBlob = await imageResponse.blob();
        //             const reader = new FileReader();
        //             reader.onloadend = () => {
        //                 images[i] = { preview: reader.result };
        //                 form.images[i] = reader.result;
        //             };
        //             reader.readAsDataURL(imageBlob);
        //         }
        //     }
        //     const formData = new FormData();
        //     form.images.forEach((image, index) => {
        //         formData.append(`images[${index}]`, image);
        //     });
        //     try {
        //         loading.value = true;
        //         const response = await axios.post('/api/academy/slidepicture/store', formData, {
        //             headers: {
        //                 'Content-Type': 'multipart/form-data',
        //             }
        //         });
        //         console.log(response);
        //     } catch (error) {
        //         console.error('Error uploading images:', error);
        //     } finally {
        //         loading.value = false;
        //     }
        // };

        // const loadSlideImages = async () => {
        //     try {
        //         const id = 10;
        //         const response = await axios.get(`/api/academy/slidepicture/find/${id}`);

        //         if (response.data.pictures && response.data.pictures.length) {
        //             for (let i = 0; i < response.data.pictures.length; i++) {
        //                 const picturePath = `/backend/images/slidepicture/${response.data.pictures[i]}`;
        //                 const imageResponse = await fetch(picturePath);
        //                 const imageBlob = await imageResponse.blob();
        //                 const reader = new FileReader();
        //                 reader.onloadend = () => {
        //                     images[i] = { preview: reader.result };
        //                     form.images[i] = reader.result;
        //                 };
        //                 reader.readAsDataURL(imageBlob);
        //             }
        //         }
        //     } catch (error) {
        //         console.error('Error fetching slide pictures:', error);
        //     }
        // };

        const loadSlideImages = async () => {
            try {
                const id = 14;
                const response = await axios.get(`/api/academy/slidepicture/find/${id}`);
                console.log(response)
                academy_id.value = response.data.id;
                if (response.data.pictures && response.data.pictures.length) {
                    response.data.pictures.forEach((picture, index) => {
                        images[index] = { preview: `/backend/images/slidepicture/${picture}` };
                        form.images[index] = picture;
                    });
                }
            } catch (error) {
                console.error('Error fetching slide pictures:', error);
            }
        };


        onMounted(() => {
            loadSlideImages();
        });

        return {
            images,
            form,
            loading,
            onFileSelect,
            addImageField,
            removeImageField,
            handleSubmit,
            loadSlideImages
        };
    },
};
</script>

<style scoped>
.btn-sm {
    padding: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
