const d = document;

const partners = d.getElementById('tree').dataset.tree;
const $container = d.getElementById('tree');

function filterData () {

    let data = JSON.parse(partners)
console.log(data);
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
    
    var datos=[];
parsed.forEach(element => {
    
    if (element.idrel==0) {
       let dat ={
            'id':element.idrel,
            'name':'BESANA GLOBAL',
            'img'  : "img/logonew.png",
            'email':element.Email
        }
        datos.push(dat)
        dat={};
        return;
    }
    if (element.idrel==1) {
        let dat ={
            'id':element.idrel,
            'pid':0,
            'name':element.Name,
            'img'  : "img/logonew.png",
            'email':element.Email

        }
        datos.push(dat)
        dat={};
        return;
    } else {

      let  dat ={
            'id':element.idrel,
            'pid':element.PID,
            'name':element.Name,
            'img'  : "img/logonew.png",
            'email':element.Email

        }
    datos.push(dat)

    }
});

console.log(datos)
let set                 = new Set( datos.map( JSON.stringify ) )
let arrSinDuplicaciones = Array.from( set ).map( JSON.parse );
console.log(arrSinDuplicaciones)
       OrgChart.templates.myTemplate = Object.assign({}, OrgChart.templates.diva);
       OrgChart.templates.myTemplate.size = [200,170];
       OrgChart.templates.myTemplate.plus ='<circle cx="15" cy="15" r="15" fill="#ffffff" stroke="#aeaeae" stroke-width="1"></circle>'
       + '<text text-anchor="middle" style="font-size: 18px;cursor:pointer;" fill="#757575" x="15" y="22">{collapsed-children-total-count}</text>';
   

      let chart = new OrgChart($container, {
        collapse: {
            level: 9,
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
        nodes: arrSinDuplicaciones,
        
    })

   
  
})

