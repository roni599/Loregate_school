<template>
    <div class="victory mb-4  container w-100">
        <div class="row  w-100">
            <div class="col-md-3 mb-3">
                <router-link to="/home-winnergalleryAll">
                    <img src="../../../../public/frontend/images/winner.png" alt="Winner" class="winner-image">
                </router-link>
            </div>
            <div v-for="item in displayDataWinner" :key="item.id" class="col-md-3 mb-3 mt-1">
                <div class="winner_image_sub d-flex justify-content-center gap-3">
                    <div class="winner_image">
                        <img :src="`/backend/images/winnergallery/${item.image}`" alt="Winner Image"
                            class="winner-img2">
                    </div>

                    <div class="subject_details">
                        <p class="no-space">{{ item.event_name }}</p>
                        <p class="no-space">{{ item.name }}</p>
                        <p class="no-space">Class: {{ item.class }}</p>
                        <p class="no-space">Roll/UID: {{ item.roll_or_uid }}</p>
                        <p class="no-space">Lavel: {{ item.winning_place }}</p>
                        <p class="no-space">Price: {{ item.price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "WinnerGallery",
    props: {
        WinnerGallery: {
            type: Array,
            required: true
        },
        displayDataWinner: {
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
.winner-image {
    width: 279px;
    height: 120px;
}

.winner-img2 {
    width: 100px;
    height: 100px;
}
</style>