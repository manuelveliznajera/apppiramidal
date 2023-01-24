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

    let parsed = filterData()//contiene la data ya eliminado el grandchild items

       OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.diva);
       OrgChart.templates.myTemplate.size = [200,170];
       OrgChart.templates.myTemplate.plus ='<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
       + '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{collapsed-children-total-count}</text>';
   

      let chart = new OrgChart($container, {
        collapse: {
            level: 2,
            allChildren: true
        },
        mouseScrool: OrgChart.action.none,
        template: "myTemplate",
        enableDragDrop: true,
        enableSearch: true,
        nodeBinding: {
            field_0: "name",
            field_1: "rank",
            img_0: "img"

        },
        nodes: parsed,
        
    })

    console.log(chart)
  
})

