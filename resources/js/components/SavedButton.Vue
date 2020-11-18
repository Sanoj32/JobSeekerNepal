<template>
    <span>

        <button
            class="btn btn-light ml-3"
            @click="saved"
            v-text="buttonText"
        ></button>

    </span>
</template>

<script>
export default {
    props: ["jobsId", "savedjobs"],
    mounted() {
        console.log("Saved button mounted.");
    },
    data: function() {
        return {
            status: this.savedjobs,
            statusr: !this.savedjobs
        };
    },

    methods: {
        saved() {
            axios.post("/saved/" + this.jobsId).then(response => {
                 this.status = !this.status;
                 this.statusr = !this.status;
            });
        }
    },

    computed: {
        buttonText() {
            return this.status ? "✔️" : "Save";
        }
    }
};
</script>