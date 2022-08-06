# Bunny Logic for Graph

- have nodes marked as darkworld (or moonpearl)
- have nodes marked as not darkworld (means lightworld)
- have item map for items (edges) affected:
  - FireRod -> DarkFireRod
  - Bush -> DarkBush
  - Bombs -> DarkBombs
- initial traversal of graph with all edges enabled:
  - if on darkworld node and connecting node is darkworld, replace edge with darkworld edge.
  - if in darkworld and connecting node has nothing, add darkworld edge.
  - if in darkworld and connecting node is lightworld, do nothing

## Example

- South Kakariko (pearl = false)
  - fixed
- Brother right (pearl = null)
  - bombs (e1)
- Brother left (pearl = null)
  - bombs (e2)
- darkworld totems (pearl = true)

becomes:

e2:

- Brother left - bombs -> darkworld totems
- darkworld totems - DarkBombs -> Brother left

e1:

- Brother right - bombs -> Brother left
- Brother left - Darkbombs -> Brother right
