<template>
    <div>
        <i  :class="defaultStyle" @click="followUser" style="margin-right: 20px;color: #e01b24;"> {{ likescount }}</i>
        
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
                        this.fetchLikesCount();
                        this.fetchIsLiked();
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            },
            fetchLikesCount() {
                axios.get('/likes_count/'+this.postId)
                    .then(response => {
                        this.likescount = response.data.data; // Assuming your data is nested under 'data' key
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            fetchIsLiked() {
                axios.get('/isliked/'+this.postId)
                    .then(response => {
                        
                        this.isliked = response.data.data; // Assuming your data is nested under 'data' key
                        console.log(this.isliked);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        },
    }
</script>