<template>
    <div>
        <i  :class="defaultStyle" @click="followUser" style="margin-right: 20px;color: #e01b24;">{{ likescount }}</i>
        
    </div>
</template>
<script>
    export default {
        props: ['postId', 'likes', 'likeCount'],

        mounted() {
            console.log('Component mounted.')
        },
        data:
            function(){
                return{
                    isliked: this.likes,
                    likescount: this.likeCount
                }
        },
        computed: {
            defaultStyle () {
                    return this.isliked?"fa-solid fa-heart ":"fa-regular fa-heart " 
            }
        },

        methods: {
            
            followUser() {
                

                axios.post('/like/' + this.postId)
                    .then(response => {
                        this.isliked = !this.likes;
                        if(this.isliked){
                            this.likescount += 1;
                        }
                        else{
                            this.likescount -= 1;
                        }
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
    }
</script>