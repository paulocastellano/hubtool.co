export default {
    kFormatter(num) {
        return Math.abs(num) > 999
            ? Math.sign(num) * (Math.abs(num) / 1000).toFixed(1) + "k"
            : Math.sign(num) * Math.abs(num);
    },


    formatDate(date) {
        return dayjs(date).format("MMM D, YYYY");
    },


    diffForHumansWithTimezone(date, timezone) {
        let localDate = dayjs
            .utc(date)
            .tz(timezone)
            .format("YYYY-MM-DD HH:mm:ss");
        return dayjs().to(dayjs(localDate));
    },

    transparentize(value, opacity) {
        var alpha = opacity === undefined ? 0.5 : 1 - opacity;
        return colorLib(value).alpha(alpha).rgbString();
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
