<template>
    <div>
        <button
            class="btn btn-primary ml-4"
            @click="viewed"
            v-text="buttonText"
        ></button>
    </div>
</template>

<script>
export default {
    props: ["jobsId", "viewedjobs"],
    mounted() {
        console.log("Component mounted.");
    },
    data: function() {
        return {
            status: this.viewedjobs
        };
    },

    methods: {
        viewed() {
            axios.post("/viewed/" + this.jobsId).then(response => {
                console.log(response.data);
            });
        }
    },

    computed: {
        buttonText() {
            return this.status ? "Opened" : "Mark as opened";
        }
    }
};
</script>
