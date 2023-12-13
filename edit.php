
<div class="p-4">
    <table class="w-full border">
        <tr class="border-b">
            <label for="text1">hinzufügen für 1. Stunde</label>
            <input type="text" name="text1" id="text1">
            <label for="text2">hinzufügen für 2. Stunde</label>
            <input type="text" name="text2" id="text2">
            <label for="text3">hinzufügen für 3. Stunde</label>
            <input type="text" name="text3" id="text3">
        </tr>
        <tr class="border-b">
            <label for="text4">hinzufügen für 4. Stunde</label>
            <input type="text" name="text4" id="text4">
            <label for="text5">hinzufügen für 5. Stunde</label>
            <input type="text" name="text5" id="text5">
            <label for="text6">hinzufügen für 6. Stunde</label>
            <input type="text" name="text6" id="text6">
        </tr>
    </table>
    <table class="w-full border">
    <tr>
        <button type="button" class="h-10" id="add-btn">neue angebote hinzufügen</button>
    </tr>

        <tr name="1" id="1" class="border-b">
        </tr>
        <tr name="2" id="2" class="border-b">
        </tr>
        <tr name="3" id="3" class="border-b">
        </tr>
        <tr name="4" id="4" class="border-b">
        </tr>
        <tr name="5" id="5" class="border-b">
        </tr>
        <tr name="6" id="6" class="border-b">
        </tr>
    </table>
    <script>
         function addNewElements(){
        
        var element1 =document.getElementById("text1");
        var element2 =document.getElementById("text2");
        var element3 =document.getElementById("text3");
        var element4 =document.getElementById("text4");
        var element5 =document.getElementById("text5");
        var element6 =document.getElementById("text6");
        console.log(currentElement.textContent);
        if(currentElement?.textContent != null || currentElement.textContent==""){
            var data = {toAdd: [
                element1.textContent, 
                element2.textContent, 
                element3.textContent, 
                element4.textContent, 
                element5.textContent,
                element6.textContent]}
            fetch('http://'+window.location.host+'/info-orientierungstag/add-option.html', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data), 
            })
            .then(response => response.text());
            }
        }
        
    
        
         
        function submit(currentCell, currentRow){
            
            
            //todo here us stuff to change
            var data = {deleteRow: currentRow, deleteCell: currentCell};
            console.log(JSON.stringify(data));
            fetch('http://'+window.location.host+'/info-orientierungstag/save-delete-options.php', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data), 
            })
            .then(response => response.text())
            .then(data => console.log(data));
            }

            

    </script>

</div>
<script>
fetch('slots.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(slotsData => {
        const selectElements = document.querySelectorAll('tr[id]'); 
        //change this stuff for the right type td/tr/ecc
        a = 0;
        selectElements.forEach((select, index) => {
            a = 0;
            slotsData.slots[index].forEach(option => {
                const optionElement = document.createElement('td');
                optionElement.id = a;
                a++;
                optionElement.textContent = option;
                select.appendChild(optionElement);
                const deleteButton = document.createElement('button');
                deleteButton.id = 'button-delete';
                deleteButton.textContent = 'Delete';
                optionElement.appendChild(deleteButton);
                deleteButton.className = 'text-sm p-1 float-right';
                deleteButton.addEventListener('click', function(event){
                    const currentCell = event.target.parentNode; // Get the parent td
                    const currentRow = currentCell.parentNode.id;
                    console.log(currentCell.id, currentRow);
                    submit(currentCell.id, currentRow);
                });
            });
        });
    })
    .catch(error => {
        console.error('Error loading or parsing JSON file:', error);
    });
    document.getElementById("add-btn").addEventListener("click", function(){
        addNewElements();
    })
   

    
</script>       

