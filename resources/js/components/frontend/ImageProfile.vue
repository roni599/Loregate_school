<template>
    <div class="row align-items-center">
        <div class="col-12 col-md-6 mb-3 order-1 order-md-2">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div v-if="slidePicture.image1" class="carousel-item active">
                        <img :src="`/backend/images/slidevalue/${slidePicture.image1}`"
                            class="carousel-img d-block w-100" alt="School 1">
                    </div>
                    <div v-if="slidePicture.image2" class="carousel-item">
                        <img :src="`/backend/images/slidevalue/${slidePicture.image2}`"
                            class="carousel-img d-block w-100" alt="School 2">
                    </div>
                    <div class="carousel-item" v-if="slidePicture.image3">
                        <img :src="`/backend/images/slidevalue/${slidePicture.image3}`"
                            class="carousel-img d-block w-100" alt="School 3">
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-6 col-md-3 text-center mt-4 mb-3 mb-md-0 order-2 order-md-1 d-flex flex-column align-items-center">
            <img v-if="leftPicture.image" :src="`/backend/images/leftpicture/${leftPicture.image}`" width="150px" alt="" class="img-fluid">
            <div class="details_name py-3">
                <p>{{ leftPicture.name }}</p>
                <p>{{ leftPicture.designation }}</p>
            </div>
        </div>
        <div class="col-6 col-md-3 text-center mb-3 mb-md-0 mt-4 order-3 order-md-3 d-flex flex-column align-items-center">
            <img v-if="rightPicture.image" :src="`/backend/images/rightpicture/${rightPicture.image}`" width="150px" alt="" class="img-fluid">
            <div class="details_name py-3">
                <p>{{ rightPicture.name }}</p>
                <p>{{ rightPicture.designation }}</p>
            </div>
        </div> -->

        <div
            class="col-6 col-md-3 text-center mt-4 mb-3 mb-md-0 order-2 order-md-1 d-flex flex-column align-items-center">
            <img v-if="leftPicture.image" :src="`/backend/images/leftpicture/${leftPicture.image}`" alt=""
                class="img-fluid fixed-image">
            <div class="details_name py-3">
                <p>{{ leftPicture.name }}</p>
                <p>{{ leftPicture.designation }}</p>
            </div>
        </div>
        <div
            class="col-6 col-md-3 text-center mb-3 mb-md-0 mt-4 order-3 order-md-3 d-flex flex-column align-items-center">
            <img v-if="rightPicture.image" :src="`/backend/images/rightpicture/${rightPicture.image}`" alt=""
                class="img-fluid fixed-image">
            <div class="details_name py-3">
                <p>{{ rightPicture.name }}</p>
                <p>{{ rightPicture.designation }}</p>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "ImageProfile",
    props: {
        slidePicture: {
            type: Object,
            required: true
        },
        leftPicture: {
            type: Object,
            required: true
        },
        rightPicture: {
            type: Object,
            required: true
        }
    },
    setup() {
        return {
        }
    }
}
</script>
<style scoped>
@media (max-width: 767px) {
    .carousel-inner img {
        height: 150px;
    }

    .d-flex {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .col-6 {
        flex: 0 0 50%;
    }
}

.carousel-img {
    width: 100px;
    height: 240px;
    /* object-fit: contain;
    object-position: center; */
}

.fixed-image {
    width: 150px;
    height: 200px;
    object-fit: cover;
}
</style>
