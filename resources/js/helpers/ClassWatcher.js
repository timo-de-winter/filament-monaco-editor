export default class ClassWatcher {
    observer = null;

    constructor(targetNode, classChangedCallback) {
        const observer = new MutationObserver(mutations => {
            for (const item of mutations) {
                if (item.attributeName === 'class') {
                    classChangedCallback();
                }
            }
        });

        observer.observe(targetNode, {attributes: true});

        this.observer = observer;
    }

    destroy() {
        this.observer.disconnect();
    }
}
