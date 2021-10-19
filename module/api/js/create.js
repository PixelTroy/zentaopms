var app = new Vue({
    el: '#apiApp',
    data: {
        header: [],
        queryP: [],
        body: [],
        params: "",
        response: "",
        defaultHeader: {field: '', required: '', desc: ''},
    },
    created() {
        this.header.push({...this.defaultHeader});
        this.queryP.push({...this.defaultHeader});
    },
    watch: {
        header: {
            handler() {
                this.setParams();
            },
            deep: true
        },
        queryP: {
            handler() {
                this.setParams();
            },
            deep: true
        },
        body: {
            handler() {
                this.setParams();
            },
            deep: true
        }
    },
    methods: {
        changeAttr(val) {
            this.body = val;
        },
        changeRes(val) {
            val = this.filterParams(val)
            this.response = JSON.stringify(val);
        },
        setParams() {
            const header = this.filterParams(this.header)
            const body = this.filterParams(this.body)
            const queryP = this.filterParams(this.queryP)
            console.log(header);
            const params = {
                header: header,
                params: body,
                query: queryP,
            }
            this.params = JSON.stringify(params);
        },
        filterParams(data) {
            const res = []
            data.forEach(item => {
                if (item.field && item.field.length > 0) {
                    res.push(item)
                }
            })
            return res
        },
        del(data, key) {
            if (data.length <= 1) {
                return;
            }
            data.splice(key, 1);
        },
        add(data, key, t) {
            if (t == "header" || t == 'query') {
                data.splice(key + 1, 0, {...this.defaultHeader})
            }
        }
    }
})
