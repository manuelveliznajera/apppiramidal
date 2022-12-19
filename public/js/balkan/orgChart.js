const d = document;

const partners = d.getElementById('tree').dataset.tree;
const $container = d.getElementById('tree');

d.addEventListener('DOMContentLoaded',()=>{

    let parsed = JSON.parse(partners)

      let chart = new OrgChart($container, {
        template: "ana",
        nodeBinding: {
            field_0: "name",
            field_1: "nivel",

        },
        nodes: parsed
    })

    OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.ana);


    console.log(parsed)
})

