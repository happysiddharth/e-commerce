/**
 * Created by Siddharth on 19-Oct-19.
 */
window.addEventListener('DOMContentLoaded',function () {
    function create_div( ob ){

        let close = document.createElement('span');
        close.innerText='x';
        close.style.cssText="position:absolute;right:5px;font-weight:bolder;cursor:pointer;color:red;font-size:20px;";

        close.onclick=function () {
            document.body.removeChild(this.parentNode.parentNode);

        }

        let x = document.createElement('div');
        x.style.cssText="position:fixed;width:100%;height:100%;z-index:449494;top:0;left:0;background:rgba(17, 12, 10 ,0.5)";

        let y = document.createElement('div');
        y.style.cssText="position:absolute;height:150px;width:70% ;padding:5px; ;border-radius:5px ;background:white;top:40%;left:15%;box-shadow: 4px 6px 22px -6px rgba(0,0,0,0.75)";

        let title = document.createElement('h4');
        title.innerText="Select size";
        title.style.cssText="text-align:center";

        let sub_title = document.createElement('h6');
        sub_title.innerText='Size available';



        let a = document.createElement('div');
        a.setAttribute('class','form-check form-check-inline');
        a.style.cssText="padding:5px;";
        let b= document.createElement('input');
        b.setAttribute('class','form-check-input');
        b.setAttribute('type','radio');
        b.setAttribute('name','size');
        b.setAttribute('value','xs');

        let c=document.createElement('lable');
        c.setAttribute('class','form-check-label');
        c.innerText="Extra small";

        //appending
        a.appendChild(b);
        a.appendChild(c);

        let small_div = a;

        let small= document.createElement('input');
        small.setAttribute('class','form-check-input');
        small.setAttribute('type','radio');
        small.setAttribute('name','size');
        small.setAttribute('value','s');

        let small_lable=document.createElement('lable');
        small_lable.setAttribute('class','form-check-label');
        small_lable.innerText="Small";

        //appending
        small_div.appendChild(small);
        small_div.appendChild(small_lable);

        let medium_div = a;

        let medium= document.createElement('input');
        medium.setAttribute('class','form-check-input');
        medium.setAttribute('type','radio');
        medium.setAttribute('name','size');
        medium.setAttribute('value','m');

        let medium_lable=document.createElement('lable');
        medium_lable.setAttribute('class','form-check-label');
        medium_lable.innerText="Medium";
        //appending
        medium_div.appendChild(medium);
        medium_div.appendChild(medium_lable);

        let large_div =a;
        let large= document.createElement('input');
        large.setAttribute('class','form-check-input');
        large.setAttribute('type','radio');
        large.setAttribute('name','size');
        large.setAttribute('value','l');

        let large_lable=document.createElement('lable');
        large_lable.setAttribute('class','form-check-label');
        large_lable.innerText="Large";

        //appending
        large_div.appendChild(large);
        large_div.appendChild(large_lable);

        let extra_large_div = a;
        let extra_large= document.createElement('input');
        extra_large.setAttribute('class','form-check-input');
        extra_large.setAttribute('type','radio');
        extra_large.setAttribute('name','size');
        extra_large.setAttribute('value','xl');

        let extra_large_lable=document.createElement('lable');
        extra_large_lable.setAttribute('class','form-check-label');
        extra_large_lable.innerText="Extra large";

        extra_large_div.appendChild(extra_large);
        extra_large_div.appendChild(extra_large_lable);



        let continue_button = document.createElement('button');
        continue_button.setAttribute('class','btn-primary');
        continue_button.innerText='Continue';

        continue_button.onclick = function () {
            let obj = document.querySelector("input[name='size']:checked");
            obj.setAttribute('type','hidden');
            ob.appendChild(obj);
            ob.submit();

        }




        y.appendChild(close);
        y.appendChild(title);
        y.appendChild(sub_title);
        y.appendChild(a);
        y.appendChild(small_div);
        y.appendChild(medium_div);
        y.appendChild(large_div);
        y.appendChild(extra_large_div);
        y.appendChild(continue_button);

        x.appendChild(y);


        document.body.appendChild(x);

    }
    var add_to_cart_form = document.getElementsByClassName('add_cart');
    for(let i=0;i<add_to_cart_form.length;i++){
        add_to_cart_form[i].addEventListener('submit',function (e) {
            e.preventDefault();
            console.log(this.childNodes[1].value);
            create_div(this);

        })
    }


})
