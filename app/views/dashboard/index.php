<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Ustadzah AI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background: #fff; margin: 0; color: #333; overflow-x: hidden; }
        
        /* Header & Navigation */
        .header { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-bottom: 1px solid #f0f0f0; }
        .header-title { font-weight: bold; font-size: 18px; color: #fb5c82; display: flex; align-items: center; gap: 8px;}
        .header-actions a { color: #666; text-decoration: none; margin-left: 15px; font-size: 14px; }
        
        .tabs-container { padding: 15px 20px; display: flex; gap: 10px; overflow-x: auto; white-space: nowrap; -webkit-overflow-scrolling: touch; scrollbar-width: none; border-bottom: 1px solid #f0f0f0; }
        .tabs-container::-webkit-scrollbar { display: none; }
        .tab-btn { background: #f5f5f5; border: none; padding: 8px 16px; border-radius: 20px; font-family: inherit; font-weight: 600; font-size: 14px; color: #555; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: 0.2s; }
        .tab-btn.active { background: #fb5c82; color: white; }
        
        .content-container { padding: 20px; max-width: 800px; margin: 0 auto; }
        
        /* Section Header */
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-header h2 { margin: 0; font-size: 18px; font-weight: bold; color: #111; }
        .btn-tambah { background: #fb5c82; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-family: inherit; font-weight: 600; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-tambah:hover { opacity: 0.9; }

        /* Card List */
        .list-card { border: 1px solid #eaeaea; border-radius: 12px; padding: 12px 16px; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; background: white; transition: 0.2s; }
        .list-card:hover { border-color: #fb5c82; box-shadow: 0 4px 12px rgba(251, 92, 130, 0.05); }
        .card-left { display: flex; align-items: center; gap: 15px; flex: 1; min-width: 0; }
        .card-avatar { width: 44px; height: 44px; border-radius: 12px; display: flex; justify-content: center; align-items: center; color: white; font-weight: bold; font-size: 18px; flex-shrink: 0; }
        .card-info { flex: 1; min-width: 0; }
        .card-title { font-weight: 600; font-size: 15px; color: #222; margin: 0 0 4px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .card-subtitle { font-size: 13px; color: #888; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .card-actions { display: flex; gap: 15px; margin-left: 15px; flex-shrink: 0; }
        .card-actions button { background: none; border: none; cursor: pointer; font-size: 16px; padding: 4px; transition: 0.2s; }
        .btn-edit { color: #555; }
        .btn-edit:hover { color: #111; }
        .btn-delete { color: #ef4444; }
        .btn-delete:hover { color: #dc2626; }

        /* Messages */
        .msg-box { border-left: 4px solid #fb5c82; background: #fff0f5; padding: 15px; margin-bottom: 15px; border-radius: 0 8px 8px 0; }
        .msg-time { font-size: 12px; color: #666; margin-bottom: 5px; }
        .msg-title { font-weight: bold; margin-bottom: 5px; }

        /* Modal */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; justify-content: center; align-items: center; z-index: 1000; }
        .modal-overlay.active { display: flex; }
        .modal-content { background: white; padding: 25px; border-radius: 15px; width: 90%; max-width: 450px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .modal-header h3 { margin: 0; color: #111; font-size: 18px; }
        .btn-close { background: none; border: none; font-size: 20px; color: #888; cursor: pointer; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 10px 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; font-size: 14px; box-sizing: border-box; }
        .form-control:focus { outline: none; border-color: #fb5c82; }
        .form-check { display: flex; align-items: center; gap: 8px; font-size: 14px; }
        .btn-submit { background: #fb5c82; color: white; border: none; padding: 12px; width: 100%; border-radius: 8px; font-family: inherit; font-weight: bold; font-size: 15px; cursor: pointer; margin-top: 10px; }

    </style>
</head>
<body>
    <div class="header">
        <div class="header-title">
            <i class="fas fa-shield-alt"></i> Dashboard Admin
        </div>
        <div class="header-actions">
            <a href="index.php"><i class="fas fa-external-link-alt"></i> Lihat Web</a>
            <a href="index.php?url=dashboard/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>
    </div>

    <div class="tabs-container">
        <button class="tab-btn active" onclick="switchTab('aplikasi')"><i class="fas fa-th-large"></i> Aplikasi</button>
        <button class="tab-btn" onclick="switchTab('tabel')"><i class="fas fa-magic"></i> Alat Tabel</button>
        <button class="tab-btn" onclick="switchTab('produk')"><i class="fas fa-shopping-bag"></i> Produk</button>
        <button class="tab-btn" onclick="switchTab('kajian')"><i class="fas fa-book-reader"></i> Info Kajian</button>
        <button class="tab-btn" onclick="switchTab('sosmed')"><i class="far fa-comment-dots"></i> Media Sosial</button>
        <button class="tab-btn" onclick="switchTab('pesan')"><i class="far fa-envelope"></i> Pesan Masuk</button>
    </div>

    <div class="content-container">
        <!-- Error alert -->
        <?php if(isset($data['db_error'])): ?>
            <div style="background: #fee2e2; color: #ef4444; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle"></i> <?= $data['db_error'] ?>
            </div>
        <?php endif; ?>

        <div class="section-header" id="sectionHeader">
            <h2 id="sectionTitle">Kelola Aplikasi</h2>
            <button class="btn-tambah" id="btnTambah" onclick="openAddModal()"><i class="fas fa-plus"></i> Tambah</button>
        </div>

        <div id="listContainer">
            <!-- Content will be generated by JS -->
        </div>
    </div>

    <!-- Dynamic Modal -->
    <div class="modal-overlay" id="dynamicModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Data</h3>
                <button class="btn-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <form id="dynamicForm" onsubmit="saveData(event)">
                <div id="formFields"></div>
                <button type="submit" class="btn-submit" id="submitBtn">Simpan</button>
            </form>
        </div>
    </div>

    <!-- Pass PHP data to JS -->
    <script>
        // State variables
        const state = {
            aplikasi: <?= json_encode($data['home_links'] ?? []) ?>,
            tabel: <?= json_encode($data['tabel_links'] ?? []) ?>,
            produk: <?= json_encode($data['store_links'] ?? []) ?>,
            sosmed: <?= json_encode($data['social_links'] ?? []) ?>,
            kajian: <?= json_encode($data['kajian_info'] ?? []) ?>,
            pesan: <?= json_encode($data['messages'] ?? []) ?>
        };

        const config = {
            aplikasi: {
                title: "Kelola Aplikasi",
                key: "home_links",
                showTambah: true,
                fields: [
                    { name: 'title', label: 'Judul', type: 'text', required: true },
                    { name: 'url', label: 'URL', type: 'text', required: true },
                    { name: 'icon', label: 'FontAwesome Icon Class', type: 'text', required: true },
                    { name: 'color', label: 'Background Color Class', type: 'text', required: true }
                ]
            },
            tabel: {
                title: "Kelola Alat Tabel",
                key: "tabel_links",
                showTambah: true,
                fields: [
                    { name: 'title', label: 'Judul', type: 'text', required: true },
                    { name: 'desc', label: 'Deskripsi', type: 'text', required: true },
                    { name: 'url', label: 'URL', type: 'text', required: true },
                    { name: 'icon', label: 'FontAwesome Icon Class', type: 'text', required: true },
                    { name: 'color', label: 'Warna Latar (HEX)', type: 'text', required: true },
                    { name: 'text_color', label: 'Warna Teks (HEX)', type: 'text', required: true }
                ]
            },
            produk: {
                title: "Kelola Produk",
                key: "store_links",
                showTambah: true,
                fields: [
                    { name: 'title', label: 'Judul Produk', type: 'text', required: true },
                    { name: 'shop', label: 'Nama Toko', type: 'text', required: true },
                    { name: 'url', label: 'URL Produk', type: 'text', required: true },
                    { name: 'image', label: 'URL Gambar', type: 'text', required: false },
                    { name: 'icon', label: 'FontAwesome Icon Class', type: 'text', required: true },
                    { name: 'special', label: 'Sorotan Khusus (Special)', type: 'checkbox', required: false }
                ]
            },
            sosmed: {
                title: "Kelola Media Sosial",
                key: "social_links",
                showTambah: true,
                fields: [
                    { name: 'title', label: 'Platform (Facebook/IG)', type: 'text', required: true },
                    { name: 'username', label: 'Username', type: 'text', required: true },
                    { name: 'url', label: 'URL Profil', type: 'text', required: true },
                    { name: 'icon', label: 'FontAwesome Icon Class', type: 'text', required: true }
                ]
            },
            kajian: {
                title: "Info Kajian Tunggal",
                key: "kajian_info",
                showTambah: false,
                isSingleObject: true,
                fields: [
                    { name: 'title', label: 'Judul Kajian', type: 'text', required: true },
                    { name: 'time', label: 'Waktu', type: 'text', required: true },
                    { name: 'desc', label: 'Deskripsi', type: 'textarea', required: true },
                    { name: 'wa_url', label: 'URL WhatsApp', type: 'text', required: true }
                ]
            },
            pesan: {
                title: "Pesan Masuk",
                showTambah: false
            }
        };

        const colors = ['#f472b6', '#fbbf24', '#a78bfa', '#fb923c', '#38bdf8', '#34d399'];
        let currentTab = 'aplikasi';
        let currentEditIndex = -1;

        function getInitials(text) {
            if(!text) return 'X';
            return text.replace(/<[^>]*>?/gm, '').charAt(0).toUpperCase();
        }

        function getColor(index) {
            return colors[index % colors.length];
        }

        function switchTab(tabId) {
            currentTab = tabId;
            
            // Update UI tabs
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            event.currentTarget.classList.add('active');
            
            // Update Section Header
            const conf = config[tabId];
            document.getElementById('sectionTitle').innerText = conf.title;
            document.getElementById('btnTambah').style.display = conf.showTambah ? 'inline-flex' : 'none';
            
            renderList();
        }

        function renderList() {
            const container = document.getElementById('listContainer');
            container.innerHTML = '';
            
            const data = state[currentTab];
            const conf = config[currentTab];

            if (currentTab === 'pesan') {
                if(data.length === 0) {
                    container.innerHTML = '<p style="text-align: center; color: #888;">Belum ada pesan masuk.</p>';
                    return;
                }
                data.forEach(msg => {
                    const html = `
                        <div class="msg-box">
                            <div class="msg-time">${msg.created_at}</div>
                            <div class="msg-title">${msg.nama} (${msg.kontak}) - <span style="color: #fb5c82;">${msg.jenis_acara}</span></div>
                            <div>${msg.keterangan}</div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });
                return;
            }

            if (conf.isSingleObject) {
                // Info kajian is a single object, show as a form basically, or just one card to edit
                const html = `
                    <div class="list-card">
                        <div class="card-left">
                            <div class="card-avatar" style="background: ${getColor(0)};">K</div>
                            <div class="card-info">
                                <h4 class="card-title">${data.title || 'Belum ada data'}</h4>
                                <p class="card-subtitle">${data.time || ''}</p>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="btn-edit" onclick="openEditModal(-1)" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </div>
                `;
                container.innerHTML = html;
                return;
            }

            if(data.length === 0) {
                container.innerHTML = '<p style="text-align: center; color: #888;">Belum ada data. Silakan tambah.</p>';
                return;
            }

            data.forEach((item, index) => {
                let subtitle = item.url || item.username || item.shop || '';
                let title = item.title ? item.title.replace(/<br>/g, ' ') : '';
                
                const html = `
                    <div class="list-card">
                        <div class="card-left">
                            <div class="card-avatar" style="background: ${getColor(index)};">${getInitials(title)}</div>
                            <div class="card-info">
                                <h4 class="card-title">${title}</h4>
                                <p class="card-subtitle">${subtitle}</p>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="btn-edit" onclick="openEditModal(${index})" title="Edit"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn-delete" onclick="deleteItem(${index})" title="Hapus"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });
        }

        function openAddModal() {
            currentEditIndex = -1;
            document.getElementById('modalTitle').innerText = 'Tambah Data';
            buildFormFields();
            document.getElementById('dynamicModal').classList.add('active');
        }

        function openEditModal(index) {
            currentEditIndex = index;
            document.getElementById('modalTitle').innerText = 'Edit Data';
            
            const conf = config[currentTab];
            let itemData = conf.isSingleObject ? state[currentTab] : state[currentTab][index];
            
            buildFormFields(itemData);
            document.getElementById('dynamicModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('dynamicModal').classList.remove('active');
        }

        function buildFormFields(data = null) {
            const container = document.getElementById('formFields');
            container.innerHTML = '';
            
            const fields = config[currentTab].fields;
            
            fields.forEach(f => {
                let val = data ? (data[f.name] !== undefined ? data[f.name] : '') : '';
                if(typeof val === 'string') val = val.replace(/"/g, '&quot;');
                
                let html = '';
                if(f.type === 'textarea') {
                    html = `
                        <div class="form-group">
                            <label>${f.label}</label>
                            <textarea class="form-control" name="${f.name}" rows="3" ${f.required?'required':''}>${val}</textarea>
                        </div>
                    `;
                } else if(f.type === 'checkbox') {
                    html = `
                        <div class="form-group form-check">
                            <input type="checkbox" name="${f.name}" value="1" ${val ? 'checked' : ''}>
                            <label style="margin:0;">${f.label}</label>
                        </div>
                    `;
                } else {
                    html = `
                        <div class="form-group">
                            <label>${f.label}</label>
                            <input type="text" class="form-control" name="${f.name}" value="${val}" ${f.required?'required':''}>
                        </div>
                    `;
                }
                container.insertAdjacentHTML('beforeend', html);
            });
        }

        function saveData(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const conf = config[currentTab];
            
            let newItem = {};
            conf.fields.forEach(f => {
                if(f.type === 'checkbox') {
                    newItem[f.name] = formData.get(f.name) === '1';
                } else {
                    newItem[f.name] = formData.get(f.name) || '';
                }
            });

            if(conf.isSingleObject) {
                state[currentTab] = newItem;
            } else {
                if(currentEditIndex > -1) {
                    state[currentTab][currentEditIndex] = newItem;
                } else {
                    state[currentTab].push(newItem);
                }
            }

            closeModal();
            renderList();
            pushToServer(conf.key, state[currentTab]);
        }

        function deleteItem(index) {
            if(confirm('Yakin ingin menghapus data ini?')) {
                state[currentTab].splice(index, 1);
                renderList();
                pushToServer(config[currentTab].key, state[currentTab]);
            }
        }

        function pushToServer(key, dataObj) {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerText;
            
            const formData = new FormData();
            formData.append('type', key);
            formData.append('data', JSON.stringify(dataObj));

            fetch('index.php?url=dashboard/update', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if(res.status !== 'success') {
                    alert('Gagal menyimpan ke server: ' + res.message);
                }
            })
            .catch(err => alert('Terjadi kesalahan jaringan saat menyimpan data.'));
        }

        // Initialize first tab
        renderList();
    </script>
</body>
</html>
