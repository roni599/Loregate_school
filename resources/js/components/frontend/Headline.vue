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
export default {
    name: "Headline",
    props:{
        headings:{
            type:Object,
            required:true
        }
    },
    setup() {
        return {
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