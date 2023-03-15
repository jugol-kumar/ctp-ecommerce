import {computed, watch, ref} from "vue";

export function useSlug(inputValue = null){

    const slug = computed(() =>{
        const a = 'àáäâèéëêìíïîòóöôùúüûñçßÿỳýœæŕśńṕẃǵǹḿǘẍźḧ'
        const b = 'aaaaeeeeiiiioooouuuuncsyyyoarsnpwgnmuxzh'
        const p = new RegExp(a.split('').join('|'), 'g')
        const ampersand = 'and'
        if (inputValue != null){
            return inputValue.toString().toLowerCase()
                .replace(/[\s_]+/g, '-')
                .replace(p, c =>
                    b.charAt(a.indexOf(c)))
                .replace(/&/g, `-${ampersand}-`)
                .replace(/[^\w-]+/g, '')
                .replace(/--+/g, '-')
                .replace(/^-+|-+$/g, '')
        }
    })


    console.log(slug)


    return slug;
}
