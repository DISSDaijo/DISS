<section>
    <div class="custom-container mt-5 ">
        <div class="header-section">
            <h1>Upload Files</h1>
            <p>Upload files you want to share</p>
            <p>PDF, images, Excel are allowed.</p>
        </div>
        <div class="drop-section">
            <div class="col">
                <div class="cloud-icon"></div>
                <span>Drag & Drop your files here</span>
                <span>Or</span>
                <button class="file-selector">Browse Files</button>
                <input type="file" class="file-selector-input" multiple>
            </div>
            <div class="col">
                <div class="drop-here">Drop here</div>
            </div>
        </div>
        <div class="list-section">
            <div class="list-title">Uploaded Files</div>
            <div class="list">
                <li class="in-prog">
                    <div class="col">
                        <img src="icons/image.png" alt="image" srcset="">
                    </div>
                    <div class="col">
                        <div class="file-name">
                            <div class="name">File Name Here</div>
                            <span>50%</span>
                        </div>
                        <div class="file-progress">
                            <span></span>
                        </div>
                        <div class="file-size">2.2 MB</div>
                    </div>
                    <div class="col"></div>
                </li>
            </div>
        </div>
    </div>
</section>

<style>
    .custom-container {
        text-align: center;
        width: 100%;
        max-width: 500px;
        min-height: 435px;
        margin: auto;
        background-color: white;
        border-radius: 16px;
    }

    .header-section {
        padding: 25px 0;
    }

    .header-section h1 {
        font-weight: 500;
        font-size: 1.7rem;
        text-transform: uppercase;
        color: #707EA0;
        margin: 0px;
        margin-bottom: 8px;
    }

    .header-section p {
        margin: 5px;
        font-size: 0.95rem;
    }

    .drop-section {
        min-height: 250px;
        border: 1px dashed #A8B3E3;
        background-image: linear-gradient(180deg, white, #F1F6FF);
        margin: 5px 35px 35px 35px;
        border-radius: 12px;
        position: relative;
    }

    .drop-section div.col:first-child {
        opacity: 1;
        visibility: visible;
        transition-duration: 0.2s;
        transform: scale(1);
        width: 200px;
        margin: auto;
    }

    .drop-section div.col:last-child {
        font-size: 40px;
        font-weight: 700;
        color: #c0cae1;
        position: absolute;
        top: 0px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin: auto;
        width: 200px;
        height: 55px;
        pointer-events: none;
        opacity: 0;
        visibility: hidden;
        transform: scale(0.6);
        transition-duration: 0.2s;
    }

    .drag-over-effect div.col:first-child {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transform: scale(1.1);
    }

    .drag-over-effect div.col:last-child {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }


    .drop-section .cloud-icon {
        margin-top: 25px;
        margin-bottom: 20px;
    }

    .drop-section span,
    .drop-section button {
        display: block;
        margin: auto;
        color: #707EA0;
        margin-bottom: 10px;
    }

    .drop-section button {
        color: white;
        background-color: #5874C6;
        border: none;
        outline: none;
        padding: 7px 20px;
        border-radius: 8px;
        margin-top: 20px;
        cursor: pointer;
    }

    .drop-section input {
        display: none;
    }

    .list-section {
        text-align: left;
        margin: 0px 35px;
        font-size: 0.95rem;
        color: #707EA0;
    }

    .list-section li {
        display: flex;
        margin: 15px 0;
        padding-top: 4px;
        padding-bottom: 2px;
        border-radius: 8px;
        transition-duration: 0.2s;
    }

    .list-section li:hover {
        box-shadow: #E3EAF9 0px 0px 4px 0px, #E3EAF9 0px 12px 16px 0px;
    }

    .list-section li .col {
        flex: .1;
    }

    .list-section li .col:nth-child(1) {
        flex: .15;
        text-align: center;
    }

    .list-section li .col:nth-child(2) {
        flex: .75;
        text-align: left;
        font-size: 0.9rem;
        color: #3e4046;
        padding: 8px 10px;
    }

    .list-section li .col:nth-child(2) div.name {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 250px;
        display: inline-block;
    }

    .list-section li .col .file-name span {
        color: #707EA0;
        float: right;
    }

    .list-section li .file-progress {
        width: 100%;
        height: 5px;
        margin-top: 8px;
        border-radius: 8px;
        background-color: #dee6fd;
    }

    .li-section li .file-progress span {
        display: block;
        width: 50%;
        height: 100%;
        border-radius: 8px;
        background-image: linear-gradient(120deg, #6b99fd, #9385ff);
        transition-duration: 0.4s;
    }

    .list-section li .col .file-size {
        font-size: 0.75rem;
        margin-top: 3px;
        color: #70&EA0;
    }

    .list-section li .col svg.cross,
    .list-section li .col svg.tick {
        fill: #8694d2;
        background-color: #dee6fd;
        position: relative;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    .list-section li .col svg.tick {
        fill: #50a156;
        background-color: transparent;
    }

    .list-section li.complete span,
    .list-section li.complete .file-progress,
    .list-section li.complete svg.cross {
        display: none;
    }

    .list-section li.in-prog .file-size,
    .list-section li.in-prog svg.tick {
        display: none;
    }
</style>

<script>
    const dropArea = document.querySelector('.drop-section')
    const listSection = document.querySelector('.list-section')
    const listContainer = document.querySelector('.list')
    const fileSelector = document.querySelector('.file-selector')
    const fileSelectorInput = document.querySelector('.file-selector-input')

    //upload files with browse button

    fileSelector.onclick = () => fileSelectorInput.click()
    fileSelectorInput.onchange = () => {
        [...fileSelectorInput.files].forEach((file) => {
            if (typeValidation(file.type)) {
                uploadFile(file)
            }
        })
    }

    // when file is over the drag area
    dropArea.ondragover = (e) => {
        e.preventDefault();
        [...e.dataTransfer.items].forEach((item) => {
            dropArea.classList.add('drag-over-effect')
        })
    }

    // when file leave the drop area
    dropArea.ondragleave = () => {
        dropArea.classList.remove('drag-over-effect')
    }

    //when file drop on the drag area
    dropArea.ondrop = (e) => {
        e.preventDefault();
        dropArea.classList.remove('drag-over-effect');
        if (e.dataTransfer.items) {
            [...e.dataTransfer.items].forEach((item) => {
                if (item.kind === 'file') {
                    const file = item.getAsFile();
                    if (typeValidation(file.type)) {
                        uploadFile(file);
                    }
                }
            })
        } else {
            [...e.dataTransfer.files].forEach((file) => {
                if (typeValidation(file.type)) {
                    uploadFile(file);
                }
            })
        }
    }

    //check the file type
    function typeValidation(type) {
        var splitType = type.split('/')[0]
        if (type == 'application/pdf' || splitType == 'image' || splitType == 'video') {
            return true;
        }
    }

    function uploadFile(file) {
        console.log(file);
    }
</script>
