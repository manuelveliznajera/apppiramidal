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

       OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.diva);
       OrgChart.templates.myTemplate.size = [200,170];
    // OrgChart.templates.myTemplate.node = '<circle  r="90"  ></circle>';

      let chart = new OrgChart($container, {
        mouseScrool: OrgChart.action.none,
        nodo:'dark',
        template: "myTemplate",
        enableDragDrop: true,
        enableSearch: true,
        nodeBinding: {
            field_0: "name",
            field_1: "nivel",
            img_0: "img"

        },
        nodes: parsed,
        
    })
  
})

