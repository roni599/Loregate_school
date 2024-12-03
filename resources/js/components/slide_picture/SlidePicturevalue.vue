<template>
    <div class="container-fluid">
        <div class="card mt-4 mb-3">
            <div class="card-header border-bottom-0 p-4">
                <router-link class="text-decoration-none text-info h5"
                    to="/admin-dashboard">Dashboard</router-link><span class="text-muted h5"> / Sliding-Picture</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-1">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p><i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Slide-Picture Create / Update</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                            <div v-for="(image, index) in images" :key="index" class="row mb-4 align-items-center">
                                <div class="col-md-10">
                                    <label :for="'inputFile' + index">Sliding Picture {{ index + 1 }}</label>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input v-if="index < 3" :id="'inputFile' + index" type="file"
                                            class="form-control p-3 px-4" @change="onFileSelect($event, index)" />
                                    </div>
                                    <span class="text-danger">ছবির সাইজ (899 x 363)px হতে হবে এবং 1024 কিলোবাইটের বেশী হবে না ।</span>
                                </div>
                                <div class="col-md-1">
                                    <img :src="image.preview" v-if="image.preview" width="55" height="55" />
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm"
                                        :class="index === 0 ? 'btn-primary' : 'btn-danger'"
                                        @click="index === 0 ? addImageField() : removeImageField(index)"
                                        :disabled="images.length <= 3 && index === 3">
                                        <i :class="index === 0 ? 'fas fa-plus' : 'fas fa-minus'"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-info w-100 mb-2" :disabled="loading">
                                        <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                                            aria-hidden="true"></span>
                                        <span v-if="!loading">Update Slide-Picture</span>
                                        <span v-if="loading">Updating Slide-Picture...</span>
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
import { ref, reactive, onMounted } from "vue";
import axios from "axios";

export default {
    setup() {
        const images = ref([
            { preview: null, file: null },
        ]);

        const loading = ref(false);
        const academy_id = ref(1);

        // Handle file selection
        // const onFileSelect = (event, index) => {
        //     const file = event.target.files[0];
        //     if (file && file.size <= 1048576) {
        //         // Max 1 MB
        //         const reader = new FileReader();
        //         reader.onload = (event) => {
        //             images.value[index].preview = event.target.result;
        //             images.value[index].file = event.target.result;
        //         };
        //         reader.readAsDataURL(file);
        //     } else {
        //         alert("Image must be less than 1 MB!");
        //     }
        // };

        const onFileSelect = (event, index) => {
            const file = event.target.files[0];
            if (file && file.size <= 1048576) { // Max 1 MB
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = new Image();
                    img.onload = () => {
                        if (img.width > 899 || img.height > 363) {
                            alert("Image width and height must be less than 900px and 364px respectively!");
                        } else {
                            // Set the preview and file only if the dimensions are valid
                            images.value[index].preview = e.target.result;
                            images.value[index].file = e.target.result;
                        }
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert("Image must be less than 1 MB!");
            }
        };


        // Add image field
        const addImageField = () => {
            if (images.value.length < 3) {
                images.value.push({ preview: null, file: null });
            }
        };

        // Remove image field
        const removeImageField = async (index) => {
            const imageKey = `image${index + 1}`;
            try {
                const response = await axios.post('/api/academy/slides/delete', {
                    academy_id: academy_id.value,
                    imageKey: imageKey,
                });
                console.log(response)

                if (response.data.success) {
                    images.value[index] = { preview: null, file: null };

                    Swal.fire({
                        icon: 'success',
                        title: 'Image deleted successfully',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error deleting image',
                    });
                }
            } catch (error) {
                console.error('Error deleting image:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'An error occurred while deleting the image',
                });
            }
            images.value.splice(index, 1);
        };

        // Submit form data
        // const handleSubmit = async () => {
        //     loading.value = true;
        //     console.log(images.value)
        //     const formData = new FormData();
        //     images.value.forEach((image, index) => {
        //         if (image.file) {
        //             formData.append(`images[${index}]`, image.file);
        //         }
        //     });

        //     try {
        //         const response = await axios.post("/api/slidesvlaue", formData, {
        //             headers: { "Content-Type": "multipart/form-data" },
        //         });
        //         if (response.data) {
        //             resetImages();
        //             Swal.fire({
        //                 icon: "success",
        //                 title: "Slide image is successfully uploaded",
        //             });
        //         }
        //     } catch (error) {
        //         console.error(error);
        //         Swal.fire({
        //             icon: "error",
        //             title: error.response?.data?.message || "An error occurred",
        //         });
        //     } finally {
        //         loading.value = false;
        //     }
        // };

        const handleSubmit = async () => {
            loading.value = true;
            const formData = new FormData();
            images.value.forEach((image, index) => {
                if (image.file) {
                    formData.append(`images[${index}]`, image.file);
                }
            });
            formData.append('academy_id', academy_id.value);

            try {
                const response = await axios.post("/api/academy/slidevaluepicture/update", formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                });
                if (response.data) {
                    resetImages();
                    Swal.fire({
                        icon: "success",
                        title: "Slide image is successfully uploaded",
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: "error",
                    title: error.response?.data?.message || "An error occurred",
                });
            } finally {
                loading.value = false;
            }
        };
        const resetImages = () => {
            images.value = [
                { preview: null, file: null },
                { preview: null, file: null },
                { preview: null, file: null },
            ];
        };

        // Fetch slide images
        const fetchSlidePictures = async () => {
            try {
                const response = await axios.get(`/api/academy/slidevalue/${academy_id.value}`);
                const imageKeys = ['image1', 'image2', 'image3'];
                if (response.data.id) {
                    images.value.pop({ preview: null, file: null });
                    imageKeys.forEach((key, index) => {
                        const imagePath = response.data[key];
                        if (imagePath && imagePath !== 'NULL') {
                            const fullImagePath = `/backend/images/slidevalue/${imagePath}`;
                            images.value.push({ preview: null, file: null });
                            fetchImage(fullImagePath, index);
                        } else {
                            // Keep the default empty preview if image doesn't exist
                            //images.value[index] = { preview: null, file: null };
                        }
                    });
                }
            } catch (error) {
                console.error("Error fetching slide pictures:", error);
            }
        };

        // Fetch image and set preview
        const fetchImage = (imagePath, index) => {
            fetch(imagePath)
                .then((res) => res.blob())
                .then((blob) => {
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        images.value[index].preview = reader.result;
                        images.value[index].file = reader.result;
                    };
                    reader.readAsDataURL(blob);
                })
                .catch((error) => console.error("Error fetching image:", error));
        };

        onMounted(() => {
            fetchSlidePictures();
        });

        return {
            images,
            loading,
            onFileSelect,
            addImageField,
            removeImageField,
            handleSubmit,
            resetImages,
            academy_id,
            fetchSlidePictures,
        };
    },
};
</script>

<style scoped>
/* Add any additional styles you need */
</style>
