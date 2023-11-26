export default {
    kFormatter(num) {
        return Math.abs(num) > 999
            ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + "k"
            : Math.sign(num) * Math.abs(num);
    },


    formatDate(date) {
        return dayjs(date).format("MMM D, YYYY");
    },

    copyToClipboard(url) {
        const clipboardData =
            event.clipboardData ||
            window.clipboardData ||
            event.originalEvent?.clipboardData ||
            navigator.clipboard;

        clipboardData.writeText(url);
    }
};
