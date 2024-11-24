<template>
    <div class="campus container mb-5">
        <h2 class="text-center text-info mb-4">Campus</h2>
        <div v-for="(campuspicture, index) in campusPicture" :key="campuspicture.id"
            class="campus_image row g-3 justify-content-center align-items-center">
            <div v-for="(picture, picIndex) in extractPictures(campuspicture)" :key="`picture-${index}-${picIndex}`"
                class="col-12 col-sm-6 col-md-6 d-flex justify-content-center">
                <img :src="`/backend/images/campus/${picture}`" class="img-fluid" alt="Campus Picture" />
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";

export default {
    name: "Campus-vue",
    setup() {
        const campusPicture = ref([]);

        const extractPictures = (campuspicture) => {
            return Object.keys(campuspicture)
                .filter((key) => key.startsWith("picture"))
                .map((key) => campuspicture[key]);
        };

        const campusPictureData = async () => {
            try {
                const response = await axios.get("/api/campus/pictureindex");
                if (response.data.data) {
                    campusPicture.value = response.data.data;
                }
            } catch (error) { }
        };
        onMounted(() => {
            campusPictureData();
        });
        return {
            campusPicture,
            campusPictureData,
            extractPictures
        };
    },
};
</script>

<style></style>