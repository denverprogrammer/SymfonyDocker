export type Observer<T> = (item: T | null) => void;

class ObserverSubject<T> {
    private observers: Observer<T>[] = [];
    private intervalId: NodeJS.Timeout | null = null;
    private item: T | null = null;
    private interval = 1000;

    public attach(observer: Observer<T>): void {
        this.observers.push(observer);
    }

    public detach(observer: Observer<T>): void {
        this.observers = this.observers.filter((client) => observer != client);
    }

    public getItem(): T | null {
        return this.item;
    }

    public setItem(item: T | null): void {
        this.item = item;
    }

    public updateObservers(): void {
        this.intervalId = setInterval(() => {
            this.notify(this.item);
        }, this.interval);
    }

    public stopUpdates(): void {
        if (this.intervalId) {
            clearInterval(this.intervalId);
            this.intervalId = null;
        }
    }

    private notify(item: T | null): void {
        this.observers.forEach((observer) => observer(item));
    }
}

export default ObserverSubject;
