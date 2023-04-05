import {defineStore} from "pinia";
import axios from "axios";

export const useDataStore = defineStore('data', {

    state: () => ({
        topCategories:[],
        featuredCategories:[],
        wishList:[]
    }),

    actions:{
        initTopCategories(){
            axios.get('/fetch-top-categories').then((res) => {
                this.topCategories = res.data
            }).catch((err) =>{
                console.log(err)
            })
        },
        initFeaturedCategories(){
            axios.get('/fetch-featured-categories').then((res) => this.featuredCategories = res.data)
        },
        addToWishList(item){
            this.wishList.push(item);
            this.setWishListStore();
        },
        setWishListStore(){
            localStorage.setItem('wishList', JSON.stringify(this.wishList));
        },
        initWishList() {
            const storeWishList = localStorage.getItem('wishList');
            if (storeWishList) {
                this.wishList = JSON.parse(storeWishList);
            }
        },

    },

    getters:{
        getTopCategories(){
            return this.topCategories;
        },
        getFeaturedCategories(){
            return this.featuredCategories;
        },
        getWishList(){
            return this.wishList;
        }
    }




})
