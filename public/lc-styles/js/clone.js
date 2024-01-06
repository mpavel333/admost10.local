const btn = document.querySelectorAll('.new-clone-btn');

btn.forEach(function (el) {
    const initialBlocks = document.querySelectorAll('.clone-block');
    const cloneWrapper = document.querySelector(el.dataset.wrapper);
    const cloneTemplate = el.dataset.template;
    const allClones = cloneWrapper.querySelectorAll('.clone-block');

    if (el) {

        // number in input name
        let largestNumber = 0;

        el.addEventListener('click', function (e) {
            e.preventDefault();

            const template = document.querySelector(cloneTemplate);

            const allClones = cloneWrapper.querySelectorAll('.clone-block');
            const cloneCount = parseInt(allClones.length);

            // template operations
            const templateClone = template.content.cloneNode(true);
            const cloneBlock = templateClone.querySelector('.clone-block');
            const removeBtn = templateClone.querySelector('.delete-icon-main');
            const cloneInputs = cloneBlock.querySelectorAll('.clone-input');

/*
            // getting input name and add number
            cloneInputs.forEach(function (input) {
                const currentName = input.getAttribute('name');
                let currentNumber = 0;

                // look if name has divider
                if (currentName.includes("-")) {
                    currentNumberStr = currentName.split("-")[1];

                    // check if sign is number
                    if (!isNaN(currentNumberStr)) {
                        currentNumber = parseInt(currentNumberStr);
                    }
                }

                // get larger number of input
                if (currentNumber > largestNumber) {
                    largestNumber = currentNumber;
                }
            });

            // Calculate the next available number for the new input name
            largestNumber++;

            // setting new name to fields
            cloneInputs.forEach(function (input) {
                const currentName = input.getAttribute('name');
                let inputNameNew = currentName + '-' + (largestNumber);

                input.setAttribute('name', inputNameNew);
            });
*/

            // remove created buttons
            deleteBlock(removeBtn);

            // add filled class to input if it not empty to CREATED BLOCKS
            addFilled(cloneBlock);

            // add new block
            cloneWrapper.appendChild(templateClone);

        });
    }

    // remove all existing on load buttons
    initialBlocks.forEach(function (block) {
        let btn = block.querySelector('.delete-icon-main');
        deleteBlock(btn);
    });

    // add filled class to input if it not empty to  EXISTING BLOCKS
    allClones.forEach(function (block) {
        addFilled(block);
    });

});

// check text input for text
window.addEventListener("load", (event) => {
    const textInputs = document.querySelectorAll('.text-input');

    if (textInputs) {
        textInputs.forEach(function (block) {
            addFilled(block);
        });
    }
});


// block removing
function deleteBlock(btn) {
    if (btn) {
        btn.addEventListener('click', (e) => {
            e.target.parentElement.remove();
            
            let input = document.createElement("input");
            input.name="format_del[]";
            input.type="hidden";
            input.value=btn.dataset.id;
            
            
            document.querySelector('.del-formats').append(input);
            
        });
    }
}

function addFilled(block) {
    const inputBlocks = block.querySelectorAll('input');

    inputBlocks.forEach(function (input) {
        let valCount = 0;
        input.addEventListener('input', function () {
            
            inputBlocks.forEach(function (inputBlock) {
                if (inputBlock.value !== '') {
                    valCount < inputBlocks.length ? valCount++ : inputBlocks.length;
                } else {
                    valCount = 0;
                }
            });

            if (valCount >= inputBlocks.length) {
                block.classList.add('filled');
            } else {
                block.classList.remove('filled');
            }
        });
    });
}