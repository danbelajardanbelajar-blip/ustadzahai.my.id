<style>
/* Protect React app from layout CSS conflicts */
#react-kalkulator-wrapper {
    width: 100%;
    min-height: calc(100vh - 60px);
    background-color: #f8fafc; /* matching typical tailwind gray-50 */
}
#react-kalkulator-wrapper a {
    text-decoration: none;
}
</style>
<div id="react-kalkulator-wrapper">
    <div style="padding: 15px;">
        <a href="index.php" style="color: #d3557d; display: inline-flex; align-items: center; font-size: 16px; font-weight: bold; margin-bottom: 5px;">
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Kembali ke Beranda
        </a>
    </div>
    <div id="root"></div>
</div>
