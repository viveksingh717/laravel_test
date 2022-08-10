<template>
    <div>
        <input type="text" v-model="search">
        <ul v-if="results.length > 0">
            <li v-for="result in results" :key="result.id" v-text="result.employee_name"></li>
        </ul>
    </div>
</template>
<script>
export default {
    data() {
        return {
            search: null,
            results: []
        };
    },
    watch: {
        keywords(after, before) {
            this.fetch();
        }
    },
    methods: {
        fetch() {
            axios.get('/api/search', { params: { search: this.search } })
                .then(response => this.results = response.data)
                .catch(error => {});
        }
    }
}
</script>