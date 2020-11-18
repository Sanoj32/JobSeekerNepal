<template>
    <span>

        <button
            :class="{'btn btn-primary ml-4' : status,
            'btn btn-light ml-4' : statusr
            }"
            @click="viewed"
            v-text="buttonText"
        ></button>

    </span>
</template>

<script>
export default {
    props: ["jobsId", "viewedjobs"],
    mounted() {
        console.log("Component mounted.");
    },
    data: function() {
        return {
            status: this.viewedjobs,
            statusr: !this.viewedjobs
        };
    },

    methods: {
        viewed() {
            axios.post("/viewed/" + this.jobsId).then(response => {
                this.status = !this.status;
                this.statusr = !this.status;
                console.log(this.statusr)
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
