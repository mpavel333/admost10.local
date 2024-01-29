function MultySelect(element) {
    this.element = element;

    const select = element;
    const controlSelect = select.querySelector('.control-select');
    const choosenList = select.querySelector('.choosen-list');
    const choosenWrapper = choosenList ? choosenList.querySelector('.choosen-wrapper') : '';
    const points = select.querySelectorAll('.select-point');
    const input = select.querySelector('.select-input');
    const notification = select.querySelector('.notification-count');

    let array = [];
    let string = '';

    // adding some value to array
    const addToArray = function (arr, val) {
        if (!arr.includes(val)) {
            arr.push(val);
        }
    };

    // removing some value to array
    const removeFromArray = function (arr, val) {
        return arr.filter(item => item !== val);
    };

    // writing some value to input
    const writeToInput = function (data, input) {
        let string = Array.isArray(data) ? data.join(',') : data;
        input.value = string;
    }

    // adding blocks to wrapper
    const addToChoosenList = function (val, txt, wrapper) {

        const template = '<div class="ch-block delete-block" data-val="' + val + '"><div class="delete-icon-main"></div><div class="txt">' + txt + '</div></div>';

        if (!wrapper.querySelector('[data-val="' + val + '"]')) {
            wrapper.innerHTML += template;
        }
    };

    // get array length
    const countValuesLength = function (arr) {
        return arr.length;
    }

    // set blocks active class
    const activatingBlocks = function (blocks = array(), arrayCount) {
        if (parseInt(arrayCount) > 0) {
            blocks.forEach(block => {
                block.classList.add('active');
            });
        } else {
            blocks.forEach(block => {
                block.classList.remove('active');
            });
        }
    }

    // set number of choosen blocks to notification
    const setNumberInNotification = function (block, val) {
        block.innerText = val;
    }

    // if is multy select
    points.forEach(function (point) {
        point.addEventListener('click', function () {
            let text = this.innerHTML,
                val = this.dataset.val;


            if (select.classList.contains('multiple-select')) {

                // add class choosed to point
                this.classList.add('choosed');

                // add data to array
                addToArray(array, val);

                // writing data to input
                writeToInput(array, input);

                // add block to choosen list
                addToChoosenList(val, text, choosenWrapper);

                // activating blocks if array not empty
                activatingBlocks([notification, choosenList, controlSelect], countValuesLength(array));

                // set number in notification
                setNumberInNotification(notification, countValuesLength(array));

                // get all new delete buttons
                let deleteBlockBtns = choosenWrapper.querySelectorAll('.delete-icon-main');

                deleteBlockBtns.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        let val = this.parentElement.dataset.val;
                        this.parentElement.remove();

                        // removing dataa from array
                        array = removeFromArray(array, val);

                        // writing data to input
                        writeToInput(array, input);

                        points.forEach(function (point) {
                            let getVal = point.getAttribute('data-val');

                            // remove class choosed to deleted point
                            if (getVal === val) {
                                point.classList.remove('choosed');
                            }
                        });

                        // disactivating blocks if array not empty
                        activatingBlocks([notification, choosenList, controlSelect], countValuesLength(array));

                        // set number in notification
                        setNumberInNotification(notification, countValuesLength(array));
                    });
                });

            }

            if (select.classList.contains('single-select')) {

                points.forEach(function (point) {
                    point.classList.remove('choosed');

                });

                this.classList.add('choosed');

                controlSelect.classList.add('active');
                
                string = val;

                // writing data to input
                writeToInput(string, input);
            }
        });
    });



    // Add 'show' event listener
    select.addEventListener('click', () => {
        this.triggerShowEvent();
    });


}

MultySelect.prototype.triggerShowEvent = function () {
    const showEvent = new Event('show');
    this.element.dispatchEvent(showEvent);
};

// Usage
const multySelects = document.querySelectorAll('.select-dropdown-link');

if (multySelects) {
    multySelects.forEach(function (select) {
        const pluginInstance = new MultySelect(select);

        select.addEventListener('show', function () {
            // Handle the 'show' event
            // console.log("The 'show' event was triggered!");
        });

    });
}