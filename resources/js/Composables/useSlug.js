import {computed, watch, ref} from "vue";

export function useSlug(inputValue = null){
    const slug = computed(() =>{
        const a = 'àáäâèéëêìíïîòóöôùúüûñçßÿỳýœæŕśńṕẃǵǹḿǘẍźḧ'
        const b = 'aaaaeeeeiiiioooouuuuncsyyyoarsnpwgnmuxzh'
        const p = new RegExp(a.split('').join('|'), 'g')
        const ampersand = 'and'
        if (updateForm.title != null){
            return updateForm.title.toString().toLowerCase()
                .replace(/[\s_]+/g, '-')
                .replace(p, c =>
                    b.charAt(a.indexOf(c)))
                .replace(/&/g, `-${ampersand}-`)
                .replace(/[^\w-]+/g, '')
                .replace(/--+/g, '-')
                .replace(/^-+|-+$/g, '')
        }
    })

    return slug;
}
