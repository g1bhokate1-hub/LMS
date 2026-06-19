<?php include('../../../includes/header.php'); ?>

<div class="wrapper">
    
    <?php include('../../../includes/sidebar.php'); ?>

    <div class="main-content">
        <?php include('../../../includes/topbar.php'); ?>
        <?php include('../../../includes/db.php'); ?>

        <div class="content">
            <form method="POST" action="">
                <h1>Advanced MARC Entry</h1>
                <p>MARC 21 Bibliographic Framework</p>

                <div class="marc-tabs">
                    <button type="button" class="tab-btn active" onclick="openTab('block000')">000</button>
                    <button type="button" class="tab-btn" onclick="openTab('block100')">100</button>
                    <button type="button" class="tab-btn" onclick="openTab('block200')">200</button>
                    <button type="button" class="tab-btn" onclick="openTab('block300')">300</button>
                    <button type="button" class="tab-btn" onclick="openTab('block600')">600</button>
                    <button type="button" class="tab-btn" onclick="openTab('misc')">Miscellaneous</button>
                </div>

                <div class="tab-content active-tab" id="block000">
                    <h3>000: Control Fields</h3>
                    <table class="marc-table">
                        <tr>
                            <th>Tag</th>
                            <th>Ind1</th>
                            <th>Ind2</th>
                            <th>Subfield</th>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>000</td>
                            <td>#</td>
                            <td>#</td>
                            <td>-</td>
                            <td>Resource Type</td>
                            <td>
                                <select name="marc_000_type">
                                    <option>Book</option>
                                    <option>Thesis</option>
                                    <option>Journal</option>
                                    <option>eBook</option>
                                    <option>Audio-Visual</option>
                                    <option>Map</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>001</td>
                            <td>#</td>
                            <td>#</td>
                            <td>-</td>
                            <td>Control Number</td>
                            <td>
                                <input type="text" name="marc_001" placeholder="AUTO GENERATED">
                            </td>
                        </tr>
                        <tr>
                            <td>005</td>
                            <td>#</td>
                            <td>#</td>
                            <td>-</td>
                            <td>Date/Time</td>
                            <td><input type="text" name="marc_005" value="AUTO GENERATED" readonly></td>
                        </tr>
                        <tr>
                            <td>008</td>
                            <td>#</td>
                            <td>#</td>
                            <td>-</td>
                            <td>Fixed Length Data</td>
                            <td><input type="text" name="marc_008" placeholder="Enter Fixed Data"></td>
                        </tr>
                        <tr>
                            <td>020</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>ISBN</td>
                            <td><input type="text" name="marc_020_a" placeholder="Enter ISBN"></td>
                        </tr>
                        <tr>
                            <td>022</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>ISSN</td>
                            <td><input type="text" name="marc_022_a" placeholder="Enter ISSN"></td>
                        </tr>
                        <tr>
                            <td>041</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Language Code</td>
                            <td>
                                <select name="marc_041_a">
                                    <option>eng</option>
                                    <option>mar</option>
                                    <option>hin</option>
                                    <option>urd</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>082</td>
                            <td>0</td>
                            <td>4</td>
                            <td>a</td>
                            <td>DDC Number</td>
                            <td><input type="text" name="marc_082_a" placeholder="Enter DDC"></td>
                        </tr>
                        <tr>
                            <td>082</td>
                            <td>0</td>
                            <td>4</td>
                            <td>b</td>
                            <td>Item Number</td>
                            <td><input type="text" name="marc_082_b" placeholder="Enter Item Number"></td>
                        </tr>
                    </table>
                </div>

                <div class="tab-content" id="block100">
                    <h3>100: Main Entry – Personal Name</h3>
                    <table class="marc-table">
                        <tr>
                            <th>Tag</th>
                            <th>Ind1</th>
                            <th>Ind2</th>
                            <th>Subfield</th>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>1</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Personal Name</td>
                            <td>
                                <input type="text" name="marc_100_a" placeholder="e.g. Ranganathan, S. R.">
                            </td>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>1</td>
                            <td>#</td>
                            <td>d</td>
                            <td>Dates Associated with Name</td>
                            <td>
                                <input type="text" name="marc_100_d" placeholder="e.g. 1892-1972">
                            </td>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>1</td>
                            <td>#</td>
                            <td>e</td>
                            <td>Relator Term</td>
                            <td>
                                <input type="text" name="marc_100_e" placeholder="Author / Editor / Compiler">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="tab-content" id="block200">
                    <h3>200: Title & Publication</h3>
                    <table class="marc-table">
                        <tr>
                            <th>Tag</th>
                            <th>Ind1</th>
                            <th>Ind2</th>
                            <th>Subfield</th>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>245</td>
                            <td>1</td>
                            <td>0</td>
                            <td>a</td>
                            <td>Main Title</td>
                            <td><input type="text" name="marc_245_a" placeholder="Enter Title"></td>
                        </tr>
                        <tr>
                            <td>245</td>
                            <td>1</td>
                            <td>0</td>
                            <td>b</td>
                            <td>Subtitle</td>
                            <td><input type="text" name="marc_245_b" placeholder="Enter Subtitle"></td>
                        </tr>
                        <tr>
                            <td>245</td>
                            <td>1</td>
                            <td>0</td>
                            <td>c</td>
                            <td>Statement of Responsibility</td>
                            <td><input type="text" name="marc_245_c" placeholder="Author / Editor"></td>
                        </tr>
                        <tr>
                            <td>246</td>
                            <td>3</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Variant Title</td>
                            <td><input type="text" name="marc_246_a" placeholder="Alternative Title"></td>
                        </tr>
                        <tr>
                            <td>250</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Edition Statement</td>
                            <td><input type="text" name="marc_250_a" placeholder="e.g. 2nd Edition"></td>
                        </tr>
                        <tr>
                            <td>264</td>
                            <td>#</td>
                            <td>1</td>
                            <td>a</td>
                            <td>Place of Publication</td>
                            <td><input type="text" name="marc_264_a" placeholder="Enter Place"></td>
                        </tr>
                        <tr>
                            <td>264</td>
                            <td>#</td>
                            <td>1</td>
                            <td>b</td>
                            <td>Publisher</td>
                            <td><input type="text" name="marc_264_b" placeholder="Enter Publisher"></td>
                        </tr>
                        <tr>
                            <td>264</td>
                            <td>#</td>
                            <td>1</td>
                            <td>c</td>
                            <td>Year of Publication</td>
                            <td><input type="text" name="marc_264_c" placeholder="Enter Year"></td>
                        </tr>
                    </table>
                </div>

                <div class="tab-content" id="block300">
                    <h3>300: Physical Description & Notes</h3>
                    <table class="marc-table">
                        <tr>
                            <th>Tag</th>
                            <th>Ind1</th>
                            <th>Ind2</th>
                            <th>Subfield</th>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>300</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Extent</td>
                            <td><input type="text" name="marc_300_a" placeholder="e.g. xii, 356 p."></td>
                        </tr>
                        <tr>
                            <td>300</td>
                            <td>#</td>
                            <td>#</td>
                            <td>b</td>
                            <td>Other Physical Details</td>
                            <td><input type="text" name="marc_300_b" placeholder="Illustrations / Maps"></td>
                        </tr>
                        <tr>
                            <td>300</td>
                            <td>#</td>
                            <td>#</td>
                            <td>c</td>
                            <td>Dimensions</td>
                            <td><input type="text" name="marc_300_c" placeholder="e.g. 25 cm"></td>
                        </tr>
                        <tr>
                            <td>336</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Content Type</td>
                            <td><input type="text" name="marc_336_a" placeholder="Text"></td>
                        </tr>
                        <tr>
                            <td>337</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Media Type</td>
                            <td><input type="text" name="marc_337_a" placeholder="Audio/Video"></td>
                        </tr>
                        <tr>
                            <td>338</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Carrier Type</td>
                            <td><input type="text" name="marc_338_a" placeholder="Volume"></td>
                        </tr>
                        <tr>
                            <td>490</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Series Statement</td>
                            <td><input type="text" name="marc_490_a" placeholder="Series"></td>
                        </tr>
                        <tr>
                            <td>500</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>General Note</td>
                            <td><input type="text" name="marc_500_a" placeholder="Notes"></td>
                        </tr>
                        <tr>
                            <td>520</td>
                            <td>#</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Summary</td>
                            <td><input type="text" name="marc_520_a" placeholder="Summary"></td>
                        </tr>
                    </table>
                </div>

                <div class="tab-content" id="block600">
                    <h3>600: Subjects & Access Points</h3>
                    <table class="marc-table" id="subjects-table">
                        <tr>
                            <th>Tag</th>
                            <th>Ind1</th>
                            <th>Ind2</th>
                            <th>Subfield</th>
                            <th>Description</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>600</td>
                            <td>1</td>
                            <td>0</td>
                            <td>a</td>
                            <td>Personal Name Subject</td>
                            <td><input type="text" name="marc_600_a" placeholder="Person Subject"></td>
                        </tr>
                        <tr>
                            <td>610</td>
                            <td>2</td>
                            <td>0</td>
                            <td>a</td>
                            <td>Corporate Subject</td>
                            <td><input type="text" name="marc_610_a" placeholder="Organization Subject"></td>
                        </tr>
                        <tr>
                            <td>650</td>
                            <td>#</td>
                            <td>0</td>
                            <td>a</td>
                            <td>Topical Subject</td>
                            <td><input type="text" name="marc_650_a" placeholder="Enter Subject"></td>
                        </tr>
                        <tr>
                            <td>651</td>
                            <td>#</td>
                            <td>0</td>
                            <td>a</td>
                            <td>Geographic Subject</td>
                            <td><input type="text" name="marc_651_a" placeholder="Place Subject"></td>
                        </tr>
                        <tr>
                            <td>700</td>
                            <td>1</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Added Personal Name</td>
                            <td><input type="text" name="marc_700_a" placeholder="Editor / Translator"></td>
                        </tr>
                        <tr>
                            <td>710</td>
                            <td>2</td>
                            <td>#</td>
                            <td>a</td>
                            <td>Added Corporate Name</td>
                            <td><input type="text" name="marc_710_a" placeholder="Institution"></td>
                        </tr>
                        <tr>
                            <td>856</td>
                            <td>4</td>
                            <td>0</td>
                            <td>u</td>
                            <td>Electronic Location</td>
                            <td><input type="text" name="marc_856_u" placeholder="URL / File Path"></td>
                        </tr>
                    </table>
                </div>

                <div class="tab-content" id="misc">
                    <h3>Miscellaneous: Items & Custom Fields</h3>
                    <table class="marc-table">
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>Accession Number</td>
                            <td><input type="text" name="accession_number" placeholder="Enter Accession Number"></td>
                        </tr>
                        <tr>
                            <td>Barcode</td>
                            <td><input type="text" name="barcode" placeholder="Enter Barcode"></td>
                        </tr>
                        <tr>
                            <td>Call Number</td>
                            <td><input type="text" name="call_number" placeholder="Enter Call Number"></td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td><input type="text" name="location" placeholder="e.g. A1"></td>
                        </tr>
                        <tr>
                            <td>Rack</td>
                            <td><input type="text" name="rack" placeholder="e.g. R2"></td>
                        </tr>
                        <tr>
                            <td>Shelf</td>
                            <td><input type="text" name="shelf" placeholder="e.g. S4"></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status">
                                    <option>Available</option>
                                    <option>Issued</option>
                                    <option>Lost</option>
                                    <option>Damaged</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Condition</td>
                            <td>
                                <select name="condition">
                                    <option>New</option>
                                    <option>Good</option>
                                    <option>Fair</option>
                                    <option>Poor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Vendor</td>
                            <td><input type="text" name="vendor" placeholder="Enter Vendor"></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="text" name="price" placeholder="Enter Price"></td>
                        </tr>
                        <tr>
                            <td>Acquisition Date</td>
                            <td><input type="date" name="acquisition_date"></td>
                        </tr>
                    </table>

                    <br>
                    <h3>Custom MARC Tags</h3>
                    <table class="marc-table">
                        <tr>
                            <th>Tag</th>
                            <th>Ind1</th>
                            <th>Ind2</th>
                            <th>Subfield</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="custom_tag_num" placeholder="942"></td>
                            <td><input type="text" name="custom_tag_ind1"></td>
                            <td><input type="text" name="custom_tag_ind2"></td>
                            <td><input type="text" name="custom_tag_subfield" placeholder="c"></td>
                            <td><input type="text" name="custom_tag_value" placeholder="Custom Value"></td>
                        </tr>
                    </table>
                </div>

                <div class="form-actions-bar" style="margin-top: 20px; text-align: right;">
                    <button type="submit" name="submit_marc_record" style="padding: 12px 28px; font-weight: bold; cursor: pointer;">Save MARC Record</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('../../../includes/footer.php'); ?>