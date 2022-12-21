const d = document;

const partners = d.getElementById('tree').dataset.tree;
const $container = d.getElementById('tree');

function filterData () {

    let data = JSON.parse(partners)

    data.forEach(el => {

        if(el.nivel === 'Grandchild'){
            
            delete  el.email
            delete el.phone
        }

    });

    return data;
}




d.addEventListener('DOMContentLoaded',()=>{

    let parsed = filterData()

    OrgChart.templates.anaOrange = Object.assign({}, OrgChart.templates.ana);
    OrgChart.templates.anaOrange.editFormHeaderColor = '#FFCA28';

      let chart = new OrgChart($container, {
        template: "ana",
        enableSearch: true,
        mouseScrool: OrgChart.action.none,
        nodeBinding: {
            field_0: "name",
            field_1: "nivel",

        },
        nodes: parsed,
        
    })
  
})

