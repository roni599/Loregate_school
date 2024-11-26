<template>
    <div class="headline mb-3">
        <marquee>
            <template v-for="(item, index) in headings.headings" :key="index">
                ** {{ item }} **
            </template>
        </marquee>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "Headline",
    setup() {
        const headings = ref([]);

        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/academy/heading`);
                if (response.data) {
                    headings.value = response.data.heading;
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
        onMounted(() => {
            fetchData();
        });
        return {
            headings,
        };
    },
};
</script>

<style scoped>
@media (max-width: 768px) {
    marquee {
        font-size: 1.2rem;
    }
}
</style>