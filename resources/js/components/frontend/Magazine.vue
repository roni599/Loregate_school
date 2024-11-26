<template>
    <div class="book_details container mb-4">
        <div class="row px-4">
            <div class="col-md-2">
                <router-link to="/home-magazineall" class="text-decoration-none">
                    <p class="text-center bg-danger text-white p-2">মাগাজন</p>
                </router-link>
            </div>
            <div class="col-md-1">
                <p class="text-center bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Education')">Education
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Health')">Health
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Religion')">Religion
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('News')">News</p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Story')">Story
                </p>
            </div>
            <div class="col-md-1">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Poem')">Poem</p>
            </div>
            <div class="col-md-2">
                <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Jokes')">Jokes
                </p>
            </div>
            <div class="col-md-2">
                <p class="text-center  bg-danger text-white p-2 cursor-pointer" @click="getEducationText('Magic')">Magic
                </p>
            </div>
        </div>
    </div>
    <!-- magazineList -->
    <div class="poster container mb-4">
        <div class="row px-4">
            <div v-for="magazine in displayData" :key="magazine.id" class="col-6 col-md-3 mb-3 ">
                <div class="new_education text-center">
                    <img class="mb-3" src="../../../../public/frontend/images/profile1.png" width="100px" alt="">
                    <p>{{ magazine.heading }}</p>
                    <p class="description pp">{{ truncateDescription(magazine.description) }} <br> <span class="mt-1">{{
                        formatToBanglaDate(magazine.date) }}</span></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRouter } from "vue-router";
import moment from "moment";
export default {
    name: "Magazine-vue",
    setup() {
        const magazine = ref([]);
        const router = useRouter();
        const magazineData = async () => {
            try {
                const response = await axios.get(`/api/academy/magazine`);
                if (response.data.data) {
                    magazine.value = response.data.data
                }
            } catch (error) {

            }
        }
        const displayData = computed(() => magazine.value.slice(0, 4))
        const truncateDescription = (description) => {
            if (!description) return "";
            const words = description.split(" ");
            if (words.length > 50) {
                return words.slice(0, 25).join(" ") + " [...]";
            }
            return description;
        };

        const convertToBanglaNumber = (number) => {
            const banglaDigits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
            return number.toString().split("").map((digit) =>
                banglaDigits[digit] || digit
            ).join("");
        };

        const formatToBanglaDate = (date) => {
            if (!date) return "";
            const formattedDate = moment(date).format("DD/MM/YYYY");
            return formattedDate
                .split("/")
                .map((num) => convertToBanglaNumber(num))
                .join("/");
        };

        const getEducationText = (event) => {
            if(event==='Health'){
                router.push({ name: "HealthView"});
            }
            else if(event==='Education'){
                router.push({name:"EducatonView"})
            }
            else if(event==='Religion'){
                router.push({name:'ReligionView'})
            }
            else if(event==='News'){
                router.push({name:''})
            }
            else if(event==='Story'){
                router.push({name:'StoryView'})
            }
            else if(event==='Poem'){
                router.push({name:"PoemView"})
            }
            else if(event==='Jokes'){
                router.push({name:'JokesView'})
            }
            else if(event==='Magic'){
                router.push({name:'MagicView'})
            }
            else{
                console.log('not event')
            }
        };

        onMounted(() => {
            magazineData();
        })
        return {
            magazine,
            magazineData,
            displayData,
            truncateDescription,
            formatToBanglaDate,
            getEducationText
        }
    }
}
</script>

<style scoped>
.pp {
    text-align: justify;
}

.cursor-pointer {
    cursor: pointer;
}
</style>