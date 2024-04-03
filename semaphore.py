import threading
import time
import random

# Shared buffer with a limited size
BUFFER_SIZE = 5
buffer = [None] * BUFFER_SIZE

# Semaphores for synchronization
mutex = threading.Semaphore(1)  # Mutex for mutual exclusion
empty = threading.Semaphore(BUFFER_SIZE)  # Indicates empty slots in the buffer
full = threading.Semaphore(0)  # Indicates filled slots in the buffer

# Producer function
def producer():
    for _ in range(10):  # Produce 10 items
        item = random.randint(1, 100)  # Simulate producing an item
        empty.acquire()  # Wait for an empty slot
        mutex.acquire()  # Acquire the buffer for writing
        # Add the item to the buffer
        for i in range(BUFFER_SIZE):
            if buffer[i] is None:
                buffer[i] = item
                break
        print(f"Produced {item}. Buffer: {buffer}")
        mutex.release()  # Release the buffer
        full.release()  # Notify the consumer

# Consumer function
def consumer():
    for _ in range(10):  # Consume 10 items
        full.acquire()  # Wait for a filled slot
        mutex.acquire()  # Acquire the buffer for reading
        # Remove and consume an item from the buffer
        for i in range(BUFFER_SIZE):
            if buffer[i] is not None:
                item = buffer[i]
                buffer[i] = None
                break
        print(f"Consumed {item}. Buffer: {buffer}")
        mutex.release()  # Release the buffer
        empty.release()  # Notify the producer

# Create producer and consumer threads
producer_thread = threading.Thread(target=producer)
consumer_thread = threading.Thread(target=consumer)

# Start the threads
producer_thread.start()
consumer_thread.start()

# Wait for both threads to finish
producer_thread.join()
consumer_thread.join()
