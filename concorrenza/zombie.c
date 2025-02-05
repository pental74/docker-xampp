#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>
int main () {
    pid_t child_pid;
    
    /* Create a child process. */
    child_pid = fork ();
    
    if (child_pid > 0) {// This is the parent process.
        sleep(60); // Sleep for a minute.
    }
    else { // This is the child process.
        exit(0); // Exit immediately.
    }
 return 0;
}