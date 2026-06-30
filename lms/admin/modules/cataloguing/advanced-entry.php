<?php include('../../../includes/header.php'); ?>


<div class="wrapper" style="display: flex; min-height: 100vh; align-items: stretch;">
    
    <?php include('../../../includes/sidebar.php'); ?>

    <div class="main-content" style="flex: 1; margin-left: 260px; padding: 20px; width: calc(100% - 260px); background: #f8fafc;">
        <?php include('../../../includes/topbar.php'); ?>
        <?php include('../../../includes/db.php'); ?>
        
        <div class="content-container">
            <div class="glass-card">
                
                <div class="page-header">
                    <h1>Advanced MARC Entry</h1>
                    <p>MARC 21 Bibliographic Framework & Cataloguing Desk</p>
                </div>

                <style>
                    .content-container { padding: 30px; max-width: 1200px; margin: 0 auto; }
                    
                    /* Premium Glassmorphism Container Card */
                    .glass-card { 
                        background: rgba(255, 255, 255, 0.45); 
                        backdrop-filter: blur(12px); 
                        -webkit-backdrop-filter: blur(12px); 
                        border-radius: 16px; 
                        border: 1px solid rgba(255, 255, 255, 0.25); 
                        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.08); 
                        padding: 40px; 
                        margin-bottom: 30px; 
                    }
                    
                    .page-header { margin-bottom: 30px; border-bottom: 1px solid rgba(0, 0, 0, 0.05); padding-bottom: 20px; }
                    .page-header h1 { font-size: 2.5rem; font-weight: 700; color: #1a1a1a; margin: 0 0 8px 0; letter-spacing: -0.5px; }
                    .page-header p { color: #666; margin: 0; font-size: 1.1rem; }

                    /* Interactive Tab System Engine and Hover Pop Animations */
                    .marc-tabs { 
                        display: flex; 
                        gap: 10px; 
                        margin-bottom: 35px; 
                        background: rgba(0, 0, 0, 0.03); 
                        padding: 8px; 
                        border-radius: 12px; 
                        border: 1px solid rgba(0, 0, 0, 0.02); 
                        overflow-x: auto; 
                    }
                    
                    .tab-btn { 
                        padding: 10px 24px; 
                        font-weight: 600; 
                        border-radius: 8px; 
                        border: none; 
                        background: transparent; 
                        color: #444; 
                        cursor: pointer; 
                        font-size: 0.95rem; 
                        white-space: nowrap;
                        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                    }
                    
                    /* Fluent Apple Hover Highlighting Pop-Effect */
                    .tab-btn:hover { 
                        background: rgba(0, 122, 255, 0.08); 
                        color: #007aff; 
                        transform: translateY(-1.5px); 
                    }
                    
                    /* Active Dynamic Highlighting Class State */
                    .tab-btn.active { 
                        background: #007aff !important; 
                        color: #fff !important; 
                        box-shadow: 0 4px 12px rgba(0, 122, 255, 0.25); 
                    }

                    /* Structural Metadata Data Entry Framework Tables */
                    .marc-table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 10px; border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,0.06); background: #fff; }
                    .marc-table th { background: #f8f9fa; color: #333; font-weight: 600; padding: 16px 20px; text-align: left; font-size: 0.95rem; border-bottom: 1px solid rgba(0,0,0,0.06); }
                    .marc-table td { padding: 14px 20px; border-bottom: 1px solid rgba(0,0,0,0.04); color: #444; font-size: 0.95rem; vertical-align: middle; }
                    .marc-table tr:last-child td { border-bottom: none; }
                    
                    .marc-table input[type="text"], .marc-table input[type="date"], .marc-table select { width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.12); background: #fff; color: #333; font-size: 0.95rem; outline: none; transition: all 0.2s ease; box-sizing: border-box; }
                    .marc-table input:focus, .marc-table select:focus { border-color: #007aff; box-shadow: 0 0 0 3px rgba(0,122,255,0.1); }
                    .marc-table input[readonly] { background: #f1f3f5; color: #666; cursor: not-allowed; border-color: rgba(0,0,0,0.08); }
                    
                    /* Tab panels visibility control classes */
                    .tab-content { display: none; }
                    .tab-content.active-tab { display: block; animation: fadeIn 0.35s ease-in-out; }
                    .section-title { font-size: 1.4rem; font-weight: 600; color: #222; margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px; }
                    
                    @keyframes fadeIn { from { opacity: 0; transform: translateY(4px); } to { opacity: 1; transform: translateY(0); } }
                </style>

                <form method="POST" action="/LMS/admin/controllers/CataloguingController.php">
                    
                    <div class="marc-tabs">
                        <button type="button" class="tab-btn active" data-target="block000">000</button>
                        <button type="button" class="tab-btn" data-target="block100">100</button>
                        <button type="button" class="tab-btn" data-target="block200">200</button>
                        <button type="button" class="tab-btn" data-target="block300">300</button>
                        <button type="button" class="tab-btn" data-target="block600">600</button>
                        <button type="button" class="tab-btn" data-target="misc">Miscellaneous Items</button>
                    </div>

                    <div class="tab-content active-tab" id="block000">
                        <h3 class="section-title">000: Control Fields Framework</h3>
                        <table class="marc-table">
                            <tr>
                                <th style="width: 80px;">Tag</th><th style="width: 60px;">Ind1</th><th style="width: 60px;">Ind2</th><th style="width: 80px;">Subfield</th><th>Description</th><th>Value Data Entry Field</th>
                            </tr>
                            <tr>
                                <td><strong>000</strong></td><td>#</td><td>#</td><td>-</td><td>Resource Type Architecture</td>
                                <td>
                                    <select name="marc_000_type">
                                        <option value="Book">Book (Monograph)</option>
                                        <option value="Thesis">Thesis / Dissertation</option>
                                        <option value="Journal">Journal / Serial</option>
                                        <option value="eBook">eBook Digital Media</option>
                                        <option value="Audio-Visual">Audio-Visual Media</option>
                                        <option value="Map">Map / Cartographic</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>001</strong></td><td>#</td><td>#</td><td>-</td><td>Control Unique Identifier Number</td>
                                <td><input type="text" name="marc_001" value="SYSTEM REFRESH AUTO" readonly></td>
                            </tr>
                            <tr>
                                <td><strong>005</strong></td><td>#</td><td>#</td><td>-</td><td>Latest Transaction Date/Time Stamp</td>
                                <td><input type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly></td>
                            </tr>
                            <tr>
                                <td><strong>008</strong></td><td>#</td><td>#</td><td>-</td><td>Fixed Length General Data Elements</td>
                                <td><input type="text" name="marc_008" placeholder="Enter Fixed Length Alpha-Numeric Metadata Data"></td>
                            </tr>
                            <tr>
                                <td><strong>020</strong></td><td>#</td><td>#</td><td>a</td><td>ISBN (International Standard Book Number)</td>
                                <td><input type="text" name="marc_020_a" placeholder="e.g. 978-3-16-148410-0"></td>
                            </tr>
                            <tr>
                                <td><strong>022</strong></td><td>#</td><td>#</td><td>a</td><td>ISSN (International Standard Serial Number)</td>
                                <td><input type="text" name="marc_022_a" placeholder="e.g. 2049-3630"></td>
                            </tr>
                            <tr>
                                <td><strong>041</strong></td><td>#</td><td>#</td><td>a</td><td>Language Classification Code</td>
                                <td>
                                    <select name="marc_041_a">
                                        <option value="eng">English (eng)</option>
                                        <option value="mar">Marathi (mar)</option>
                                        <option value="hin">Hindi (hin)</option>
                                        <option value="urd">Urdu (urd)</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>082</strong></td><td>0</td><td>4</td><td>a</td><td>DDC Classification Number</td>
                                <td><input type="text" name="marc_082_a" placeholder="e.g. 025.3"></td>
                            </tr>
                            <tr>
                                <td><strong>082</strong></td><td>0</td><td>4</td><td>b</td><td>Item/Author Relation Number</td>
                                <td><input type="text" name="marc_082_b" placeholder="e.g. R221p"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-content" id="block100">
                        <h3 class="section-title">100: Main Entry – Primary Author</h3>
                        <table class="marc-table">
                            <tr>
                                <th style="width: 80px;">Tag</th><th style="width: 60px;">Ind1</th><th style="width: 60px;">Ind2</th><th style="width: 80px;">Subfield</th><th>Description</th><th>Value Data Entry Field</th>
                            </tr>
                            <tr>
                                <td><strong>100</strong></td><td>1</td><td>#</td><td>a</td><td>Personal Name (Primary Author)</td>
                                <td><input type="text" name="marc_100_a" placeholder="e.g. Ranganathan, S. R."></td>
                            </tr>
                            <tr>
                                <td><strong>100</strong></td><td>1</td><td>#</td><td>d</td><td>Dates Associated with Personal Name</td>
                                <td><input type="text" name="marc_100_d" placeholder="e.g. 1892-1972"></td>
                            </tr>
                            <tr>
                                <td><strong>100</strong></td><td>1</td><td>#</td><td>e</td><td>Relator Term Responsibility Function</td>
                                <td><input type="text" name="marc_100_e" placeholder="e.g. Author / Editor / Compiler"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-content" id="block200">
                        <h3 class="section-title">245: Title & Statement of Responsibility</h3>
                        <table class="marc-table">
                            <tr>
                                <th style="width: 80px;">Tag</th><th style="width: 60px;">Ind1</th><th style="width: 60px;">Ind2</th><th style="width: 80px;">Subfield</th><th>Description</th><th>Value Data Entry Field</th>
                            </tr>
                            <tr>
                                <td><strong>245</strong></td><td>1</td><td>0</td><td>a</td><td>Main Bibliographic Title</td>
                                <td><input type="text" name="marc_245_a" placeholder="Enter full primary book title" required></td>
                            </tr>
                            <tr>
                                <td><strong>245</strong></td><td>1</td><td>0</td><td>b</td><td>Remainder of Title (Subtitle)</td>
                                <td><input type="text" name="marc_245_b" placeholder="e.g. A Modern Approach to Classification"></td>
                            </tr>
                            <tr>
                                <td><strong>245</strong></td><td>1</td><td>0</td><td>c</td><td>Statement of Responsibility</td>
                                <td><input type="text" name="marc_245_c" placeholder="e.g. Edited by Dr. Tushar Gunjal"></td>
                            </tr>
                            <tr>
                                <td><strong>246</strong></td><td>3</td><td>#</td><td>a</td><td>Varying Form of Title (Variant Title)</td>
                                <td><input type="text" name="marc_246_a" placeholder="Alternative or common shorthand titles"></td>
                            </tr>
                            <tr>
                                <td><strong>250</strong></td><td>#</td><td>#</td><td>a</td><td>Edition Statement Statement</td>
                                <td><input type="text" name="marc_250_a" placeholder="e.g. 3rd revised edition"></td>
                            </tr>
                            <tr>
                                <td><strong>264</strong></td><td>#</td><td>1</td><td>a</td><td>Place of Production / Publication</td>
                                <td><input type="text" name="marc_264_a" placeholder="e.g. Mumbai, India"></td>
                            </tr>
                            <tr>
                                <td><strong>264</strong></td><td>#</td><td>1</td><td>b</td><td>Publisher Name House</td>
                                <td><input type="text" name="marc_264_b" placeholder="e.g. Allied Publishers Private Ltd."></td>
                            </tr>
                            <tr>
                                <td><strong>264</strong></td><td>#</td><td>1</td><td>c</td><td>Date/Year of Publication Imprint</td>
                                <td><input type="text" name="marc_264_c" placeholder="e.g. 2026"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-content" id="block300">
                        <h3 class="section-title">300: Physical Description & RDA Core Attributes</h3>
                        <table class="marc-table">
                            <tr>
                                <th style="width: 80px;">Tag</th><th style="width: 60px;">Ind1</th><th style="width: 60px;">Ind2</th><th style="width: 80px;">Subfield</th><th>Description</th><th>Value Data Entry Field</th>
                            </tr>
                            <tr>
                                <td><strong>300</strong></td><td>#</td><td>#</td><td>a</td><td>Extent (Pagination / Volume Count)</td>
                                <td><input type="text" name="marc_300_a" placeholder="e.g. xxiv, 412 pages"></td>
                            </tr>
                            <tr>
                                <td><strong>300</strong></td><td>#</td><td>#</td><td>b</td><td>Other Physical Details (Illustrations)</td>
                                <td><input type="text" name="marc_300_b" placeholder="e.g. charts, maps, colored illustrations"></td>
                            </tr>
                            <tr>
                                <td><strong>300</strong></td><td>#</td><td>#</td><td>c</td><td>Dimensions (Book Height)</td>
                                <td><input type="text" name="marc_300_c" placeholder="e.g. 24 cm"></td>
                            </tr>
                            <tr>
                                <td><strong>336</strong></td><td>#</td><td>#</td><td>a</td><td>Content Type (RDA)</td>
                                <td><input type="text" name="marc_336_a" value="text" placeholder="text"></td>
                            </tr>
                            <tr>
                                <td><strong>337</strong></td><td>#</td><td>#</td><td>a</td><td>Media Type (RDA)</td>
                                <td><input type="text" name="marc_337_a" value="unmediated" placeholder="unmediated"></td>
                            </tr>
                            <tr>
                                <td><strong>338</strong></td><td>#</td><td>#</td><td>a</td><td>Carrier Type (RDA)</td>
                                <td><input type="text" name="marc_338_a" value="volume" placeholder="volume"></td>
                            </tr>
                            <tr>
                                <td><strong>490</strong></td><td>#</td><td>#</td><td>a</td><td>Series Statement Configuration</td>
                                <td><input type="text" name="marc_490_a" placeholder="Enter series catalog name if applicable"></td>
                            </tr>
                            <tr>
                                <td><strong>500</strong></td><td>#</td><td>#</td><td>a</td><td>General Bibliographic Note</td>
                                <td><input type="text" name="marc_500_a" placeholder="General structural notes about copy item"></td>
                            </tr>
                            <tr>
                                <td><strong>520</strong></td><td>#</td><td>#</td><td>a</td><td>Summary or Abstract Note</td>
                                <td><input type="text" name="marc_520_a" placeholder="Brief subject summary summary details"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-content" id="block600">
                        <h3 class="section-title">600: Subjects & Subject Headings Descriptor</h3>
                        <table class="marc-table">
                            <tr>
                                <th style="width: 80px;">Tag</th><th style="width: 60px;">Ind1</th><th style="width: 60px;">Ind2</th><th style="width: 80px;">Subfield</th><th>Description</th><th>Value Data Entry Field</th>
                            </tr>
                            <tr>
                                <td><strong>600</strong></td><td>1</td><td>0</td><td>a</td><td>Personal Name Subject Heading</td>
                                <td><input type="text" name="marc_600_a" placeholder="Biographical subject name entry"></td>
                            </tr>
                            <tr>
                                <td><strong>610</strong></td><td>2</td><td>0</td><td>a</td><td>Corporate Body Subject Heading</td>
                                <td><input type="text" name="marc_610_a" placeholder="Organization or institution level subject entry"></td>
                            </tr>
                            <tr>
                                <td><strong>650</strong></td><td>#</td><td>0</td><td>a</td><td>Topical Term Subject Heading</td>
                                <td><input type="text" name="marc_650_a" placeholder="e.g. Library Information Science"></td>
                            </tr>
                            <tr>
                                <td><strong>651</strong></td><td>#</td><td>0</td><td>a</td><td>Geographic Name Subject Heading</td>
                                <td><input type="text" name="marc_651_a" placeholder="e.g. India — History"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-content" id="misc">
                        <h3 class="section-title">Miscellaneous: Physical Holding Copy Inventory Details</h3>
                        <table class="marc-table">
                            <tr>
                                <th style="width: 280px;">Physical Parameter Field</th><th>Holding Reference Target Data Entry Field</th>
                            </tr>
                            <tr>
                                <td><strong>Accession Number (Required Master Key)</strong></td>
                                <td><input type="text" name="accession_number" placeholder="e.g. ACC-2026-8941" required style="font-weight: 600; border-color: rgba(0,122,255,0.4);"></td>
                            </tr>
                            <tr>
                                <td><strong>Barcode Serial Identifier (Required Scan Code)</strong></td>
                                <td><input type="text" name="barcode" placeholder="Scan or enter unique asset barcode string" required style="font-weight: 600; border-color: rgba(0,122,255,0.4);"></td>
                            </tr>
                            <tr>
                                <td><strong>Call Number Identifier String</strong></td>
                                <td><input type="text" name="call_number" placeholder="e.g. 025.3 R221p"></td>
                            </tr>
                            <tr>
                                <td><strong>Library Sub-Location Wing</strong></td>
                                <td><input type="text" name="location" value="Main Central Library" placeholder="e.g. Reference Section / Stack Room"></td>
                            </tr>
                            <tr>
                                <td><strong>Physical Row Rack Address</strong></td>
                                <td><input type="text" name="rack" placeholder="e.g. Rack-B4"></td>
                            </tr>
                            <tr>
                                <td><strong>Physical Holding Shelf Assignment</strong></td>
                                <td><input type="text" name="shelf" placeholder="e.g. Shelf-02"></td>
                            </tr>
                            <tr>
                                <td><strong>Circulation Status Assignment</strong></td>
                                <td>
                                    <select name="status">
                                        <option value="Available" selected>Available for Circulation</option>
                                        <option value="Issued">Issued / On Loan</option>
                                        <option value="Lost">Lost / Missing Asset</option>
                                        <option value="Damaged">Damaged / Under Repair Restoration</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Physical Condition Index</strong></td>
                                <td>
                                    <select name="condition">
                                        <option value="New">Mint / Brand New Copy</option>
                                        <option value="Good" selected>Good / Minimal Wear</option>
                                        <option value="Fair">Fair / Readable Copy</option>
                                        <option value="Poor">Poor / Binding Loose</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Procurement Source Vendor</strong></td>
                                <td><input type="text" name="vendor" placeholder="e.g. Oxford Book Distributor"></td>
                            </tr>
                            <tr>
                                <td><strong>Purchase Net Price (₹ INR)</strong></td>
                                <td><input type="text" name="price" placeholder="e.g. 450.00"></td>
                            </tr>
                            <tr>
                                <td><strong>Acquisition Accession Date</strong></td>
                                <td><input type="date" name="acquisition_date" value="<?php echo date('Y-m-d'); ?>"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-actions-bar" style="margin-top: 40px; padding-top: 25px; border-top: 1px solid rgba(0,0,0,0.05); display: flex; justify-content: flex-end;">
                        <button type="submit" name="submit_marc_record" class="submit-btn" style="background: linear-gradient(135deg, #007aff 0%, #0056b3 100%); color: #fff; border: none; padding: 16px 36px; font-size: 1.05rem; font-weight: 600; border-radius: 12px; cursor: pointer; box-shadow: 0 8px 24px rgba(0, 122, 255, 0.25); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
                            Save Cataloguing Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            // 1. Clear active state from all buttons
            buttons.forEach(b => b.classList.remove('active'));
            
            // 2. Hide all data panels completely
            contents.forEach(c => c.classList.remove('active-tab'));

            // 3. Apply active state to clicked tab
            this.classList.add('active');

            // 4. Map and reveal corresponding content pane ID
            const targetId = this.getAttribute('data-target');
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.add('active-tab');
            }
        });
    });
});
</script>

<?php include('../../../includes/footer.php'); ?>