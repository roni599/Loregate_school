<template>
    <div class="campus container mb-2">
        <h2 class="text-center textcolor mb-5">Campus</h2>
        <div v-for="(campuspicture, index) in campusPicture" :key="campuspicture.id"
            class="campus_image row justify-content-center align-items-center">
            <div v-for="(picture, picIndex) in extractPictures(campuspicture)" :key="`picture-${index}-${picIndex}`"
                class="col-12 col-sm-6 col-md-6 d-flex justify-content-center">
                    <img :src="`/backend/images/campus/${picture}`" class="img-fixed" alt="Campus Picture" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Campus-vue",
    props: {
        campusPicture: {
            type: Array,
            Object: true
        }
    },
    setup() {
        const extractPictures = (campuspicture) => {
            return Object.keys(campuspicture)
                .filter((key) => key.startsWith("picture") && campuspicture[key])
                .map((key) => campuspicture[key]);
        };
        return {
            extractPictures
        };
    },
};
</script>

<style scoped>
.textcolor{
    color: rgb(52,110,253);
}
.img-fixed {
  width: 600px;
  height: 300px;
  object-fit: cover;
  display: block;
}
@media (max-width: 768px) {
  .img-fixed {
    width: 100%; /* Full width of the container */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 15px; /* Add gap between images */
  }
  
  .campus_image {
    gap: 5px; /* Add a gap between rows */
  }
}
</style>