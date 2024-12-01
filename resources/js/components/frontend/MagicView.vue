text/x-generic MagazineAll.vue ( HTML document, UTF-8 Unicode text )
<template>
    <div class="container">
        <div class="magzine_details_all py-5 mb-3 d-flex justify-content-center align-items-center">
            <h1>Poem</h1>
            <!-- <img class="magazine-image" src="../../../../public/frontend/images/Magazine_image.png" alt="Magazine Image"><br> -->
        </div>
        <div class="book_details container mb-4">
            <div class="row px-4">
                <div class="col-md-2">
                    <router-link to="/home-magazineall" class="text-decoration-none">
                        <p class="text-center bg-danger text-white p-2">মাগাজন</p>
                    </router-link>
                </div>
                <div class="col-md-1">
                    <p class="text-center bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Education')">
                        Education
                    </p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Health')">
                        Health
                    </p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Religion')">
                        Religion
                    </p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('News')">News
                    </p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Story')">
                        Story
                    </p>
                </div>
                <div class="col-md-1">
                    <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Poem')">Poem
                    </p>
                </div>
                <div class="col-md-2">
                    <p class="text-center  bg-dark text-white p-2 cursor-pointer" @click="getEducationText('Jokes')">
                        Jokes
                    </p>
                </div>
                <div class="col-md-2">
                    <p class="text-center  bg-danger text-white p-2 cursor-pointer" @click="getEducationText('Magic')">
                        Magic
                    </p>
                </div>
            </div>
        </div>
        <div class="poster container mb-4 text-center">
            <div class="row px-4">
                <div v-for="magic in magiclists" :key="magic.id" class="col-6 col-md-3 mb-3">
                    <router-link :to="`/home-magazinelistview/${magic.id}`" class="text-decoration-none">
                        <div class="new_education">
                            <img :src="`/backend/images/magazine/${magic.image}`" :alt="magic.name"
                                class="img-fluid" width="308" height="120" />
                        </div>
                        <p>{{ magic.heading }}</p>
                        <p class="description">
                            {{ truncateDescription(magic.description) }}
                            <br />
                            <span class="mt-1">
                                {{ formatToBanglaDate(magic.date) }}
                            </span>
                        </p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import moment from "moment";
import { useRouter } from "vue-router";
export default {
    name: "EducationView",
    setup() {
        const magiclists = ref([]);
        const router = useRouter();
        const magicListData = async () => {
            try {
                const response = await axios.get(`/api/academy/magic`);
                if (response.data.data) {
                    magiclists.value = response.data.data;
                }
            } catch (error) {
                console.log(error)
            }
        }
        const formatToBanglaDate = (date) => {
            if (!date) return "";
            const formattedDate = moment(date).format("DD/MM/YYYY");
            return formattedDate
                .split("/")
                .map((num) => convertToBanglaNumber(num))
                .join("/");
        };

        const convertToBanglaNumber = (number) => {
            const banglaDigits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
            return number.toString().split("").map((digit) =>
                banglaDigits[digit] || digit
            ).join("");
        };

        const truncateDescription = (description) => {
            if (!description) return "";
            const words = description.split(" ");
            if (words.length > 50) {
                return words.slice(0, 25).join(" ") + " [...]";
            }
            return description;
        };

        const getEducationText = (event) => {
            if (event === 'Health') {
                router.push({ name: "HealthView" });
            }
            else if (event === 'Education') {
                router.push({ name: "EducatonView" })
            }
            else if (event === 'Religion') {
                router.push({ name: 'ReligionView' })
            }
            else if (event === 'News') {
                router.push({ name: 'NewsView' })
            }
            else if (event === 'Story') {
                router.push({ name: 'StoryView' })
            }
            else if (event === 'Poem') {
                router.push({ name: "PoemView" })
            }
            else if (event === 'Jokes') {
                router.push({ name: 'JokesView' })
            }
            else if (event === 'Magic') {
                router.push({ name: 'MagicView' })
            }
            else {
                console.log('not event')
            }
        };

        onMounted(() => {
            magicListData()
        })
        return {
            magiclists,
            magicListData,
            formatToBanglaDate,
            truncateDescription,
            getEducationText
        }
    }
}
</script>

<style scoped>
.description {
    text-align: justify;
}

.cursor-pointer {
    cursor: pointer;
}
</style>